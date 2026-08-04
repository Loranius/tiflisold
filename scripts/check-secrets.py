#!/usr/bin/env python3
"""Fail CI when browser-accessible source contains high-risk credentials."""

from __future__ import annotations

import pathlib
import re
import sys

ROOT = pathlib.Path(__file__).resolve().parents[1]
TEXT_SUFFIXES = {
    ".html", ".js", ".mjs", ".cjs", ".ts", ".tsx", ".json", ".css",
    ".md", ".yml", ".yaml", ".toml", ".sql", ".txt",
}
SKIP_PARTS = {".git", ".supabase", "node_modules", "dist", "build"}

# These checks intentionally focus on credentials that must never be shipped
# to a browser or committed as literal values. Publishable/anon Supabase keys
# are not treated as secrets, but service-role keys are.
PATTERNS: list[tuple[str, re.Pattern[str]]] = [
    (
        "Supabase service-role credential or variable in browser source",
        re.compile(r"(?:service[_-]?role|SUPABASE_SERVICE_ROLE_KEY)", re.I),
    ),
    (
        "hard-coded Supabase JWT assigned to SUPA_KEY",
        re.compile(r"\bSUPA_KEY\s*=\s*['\"]eyJ[A-Za-z0-9_-]+\.[A-Za-z0-9_-]+\.[A-Za-z0-9_-]+['\"]"),
    ),
    (
        "hard-coded Telegram bot token",
        re.compile(r"\b\d{7,12}:[A-Za-z0-9_-]{30,}\b"),
    ),
    (
        "legacy public portal key",
        re.compile(r"\btiflis_internal\b"),
    ),
]

# Server-side Supabase functions legitimately reference environment variable
# names. Literal secrets are still scanned there, but service-role variable
# names alone are allowed.
SERVER_PREFIX = pathlib.Path("supabase/functions")


def is_text_file(path: pathlib.Path) -> bool:
    return path.suffix.lower() in TEXT_SUFFIXES or path.name in {"Dockerfile", "Makefile"}


def should_skip(path: pathlib.Path) -> bool:
    return any(part in SKIP_PARTS for part in path.parts)


def main() -> int:
    findings: list[str] = []

    for path in ROOT.rglob("*"):
        if not path.is_file() or should_skip(path.relative_to(ROOT)) or not is_text_file(path):
            continue

        relative = path.relative_to(ROOT)
        try:
            text = path.read_text(encoding="utf-8")
        except UnicodeDecodeError:
            continue

        for label, pattern in PATTERNS:
            if relative.is_relative_to(SERVER_PREFIX) and "service-role credential" in label:
                continue

            for match in pattern.finditer(text):
                line = text.count("\n", 0, match.start()) + 1
                findings.append(f"{relative}:{line}: {label}")

    if findings:
        print("Security scan failed. Remove or rotate the following credentials/patterns:", file=sys.stderr)
        for finding in findings:
            print(f"  - {finding}", file=sys.stderr)
        return 1

    print("Security scan passed: no blocked credential patterns found.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
