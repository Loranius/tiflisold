#!/usr/bin/env python3
"""Fail CI when deployable browser source contains high-risk credentials."""

from __future__ import annotations

import pathlib
import re
import sys
from collections.abc import Iterable

ROOT = pathlib.Path(__file__).resolve().parents[1]
BROWSER_TARGETS = (
    pathlib.Path("index.html"),
    pathlib.Path("manifest.json"),
    pathlib.Path("sw.js"),
    pathlib.Path("js"),
    pathlib.Path("css"),
)
TEXT_SUFFIXES = {".html", ".js", ".mjs", ".cjs", ".ts", ".tsx", ".json", ".css"}

BROWSER_PATTERNS: list[tuple[str, re.Pattern[str]]] = [
    (
        "Supabase service-role credential in browser source",
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


def iter_files(target: pathlib.Path) -> Iterable[pathlib.Path]:
    absolute = ROOT / target
    if absolute.is_file():
        yield absolute
        return
    if absolute.is_dir():
        for path in absolute.rglob("*"):
            if path.is_file() and path.suffix.lower() in TEXT_SUFFIXES:
                yield path


def main() -> int:
    findings: list[str] = []

    for target in BROWSER_TARGETS:
        for path in iter_files(target):
            relative = path.relative_to(ROOT)
            try:
                text = path.read_text(encoding="utf-8")
            except UnicodeDecodeError:
                continue

            for label, pattern in BROWSER_PATTERNS:
                for match in pattern.finditer(text):
                    line = text.count("\n", 0, match.start()) + 1
                    findings.append(f"{relative}:{line}: {label}")

    if findings:
        print("Security scan failed. Remove and rotate the following credentials:", file=sys.stderr)
        for finding in findings:
            print(f"  - {finding}", file=sys.stderr)
        return 1

    print("Security scan passed: browser sources contain no blocked credential patterns.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
