#!/usr/bin/env python3
"""Тема WordPress «EnRay 2026 v2» з прототипу enray-v2.

Шаблони генеруються з готових сторінок прототипу (головна, сценарії, послуги): шляхи до файлів,
посилання на сторінки, телефон і форми замінюються на функції теми. Решта теми (налаштування,
меню, Contact Form 7, JSON-LD, звичайні сторінки й кейси) береться з першої теми enray-2026 і
доповнюється стилями v2. Запуск з кореня репозиторію: python3 enray-v2/tools/build_wp.py
"""
import glob
import os
import re
import shutil

V2 = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
REPO = os.path.dirname(V2)
V1T = os.path.join(REPO, 'enray', 'wp-theme', 'enray-2026')
OUT = os.path.join(V2, 'wp-theme', 'enray-2026-v2')

TEL = "<?php echo esc_attr( enray_tel() ); ?>"
VIBER = "<?php echo esc_attr( enray_viber() ); ?>"
PHONE = "<?php echo esc_html( enray_opt( 'phone' ) ); ?>"
SCEN = {'dim': '/dim/', 'biz': '/biznes/'}


def read(p):
    return open(p, encoding='utf-8').read()


def home(path='/'):
    return f"<?php echo esc_url( home_url( '{path}' ) ); ?>"


def conv(h):
    """Посилання, файли, контакти прототипу → функції теми."""
    # файли теми (у т.ч. srcset із кількома шляхами)
    h = re.sub(r'(?:\.\./)*assets/([\w./-]+)', lambda m: f"<?php echo esc_url( enray_asset( '{m.group(1)}' ) ); ?>", h)
    # сторінки сценаріїв і послуг
    def page_link(m):
        rel, frag = m.group(1), m.group(2) or ''
        parts = [p for p in rel.split('/') if p and p != '..']
        if not parts:
            return f'href="{home("/" + frag)}"'
        slug = parts[-1]
        if slug in SCEN:
            return f'href="{home(SCEN[slug] + frag)}"'
        if parts[0] == 'posluhy' and len(parts) > 1:
            slug = parts[1]
        return f'href="{home("/" + slug + "/" + frag)}"'
    h = re.sub(r'href="((?:\.\./)+|(?:\.\./)*(?:[\w-]+/)+)(#[\w-]*)?"', page_link, h)
    h = re.sub(r'href="https://enray\.com\.ua(/[^"]*)"', lambda m: f'href="{home(m.group(1))}"', h)
    h = h.replace('href="tel:+380676722244"', f'href="{TEL}"').replace('href="viber://chat?number=%2B380676722244"', f'href="{VIBER}"')
    h = h.replace('>+38 067 672 22 44<', f'>{PHONE}<').replace('aria-label="Подзвонити: +38 067 672 22 44"', "aria-label=\"Подзвонити: <?php echo esc_attr( enray_opt( 'phone' ) ); ?>\"")
    return h


def forms(h, key):
    def rep(m):
        f = m.group(0)
        sv = re.search(r'<input type="hidden" name="service" value="([^"]*)">', f)
        if sv:
            return f"<?php enray_request_form( 'service', '{sv.group(1)}' ); ?>"
        return f"<?php enray_request_form( '{key}' ); ?>"
    return re.sub(r'<form class="request-form".*?</form>', rep, h, flags=re.S)


ED = "<?php if ( current_user_can( 'edit_pages' ) ) : ?>"
EN = "<?php endif; ?>"


def editors_only(h):
    """Прогалини «уточнити» бачать лише редактори; відвідувачі — ні."""
    h = re.sub(r'<div class="is-todo">.*?</div>', lambda m: ED + m.group(0) + EN, h)
    h = re.sub(r'<details><summary>[^<]*<svg[^>]*><use[^>]*/></svg></summary><p><span class="todo">уточнити</span></p></details>', lambda m: ED + m.group(0) + EN, h)
    h = re.sub(r'  <section class="works"[^>]*>\s*<h2[^>]*>[^<]*</h2>\s*<p class="works-todo">.*?</section>', lambda m: ED + m.group(0) + EN, h, flags=re.S)
    return h


def cut(s, a, b, inc=True):
    i = s.index(a)
    j = s.index(b, i) + (len(b) if inc else 0)
    return s[i:j]


def main():
    if os.path.exists(OUT):
        shutil.rmtree(OUT)
    os.makedirs(OUT)
    # основа з першої теми
    for f in ['functions.php', 'index.php', 'page.php', '404.php', 'single.php', 'page-keysy.php']:
        shutil.copy(os.path.join(V1T, f), OUT)
    for d in ['template-parts', 'cf7']:
        shutil.copytree(os.path.join(V1T, d), os.path.join(OUT, d))
    shutil.copytree(os.path.join(V2, 'assets'), os.path.join(OUT, 'assets'))

    home_html = read(os.path.join(V2, 'index.html'))
    sprite = cut(home_html, '<svg width="0" height="0"', '</svg>').replace('</svg>', '  <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>\n</svg>')
    header = cut(home_html, '<header class="top">', '</header>')
    header = re.sub(r'<nav class="nav-links" aria-label="Основна навігація">.*?</nav>', '<nav class="nav-links" aria-label="Основна навігація"><?php enray_nav_links(); ?></nav>', header, flags=re.S)
    header = re.sub(r'(<div class="mobile-menu" id="mobile-menu" hidden>\n    ).*?(\n    <a class="btn btn-primary")', r'\1<?php enray_nav_links(); ?>\2', header, flags=re.S)
    header = header.replace('href="#top" aria-label="EnRay, на початок сторінки"', f'href="{home()}" aria-label="EnRay, на головну"')
    open(os.path.join(OUT, 'header.php'), 'w', encoding='utf-8').write(f'''<?php
/** Шапка: скляне меню над фото. Згенеровано enray-v2/tools/build_wp.py. */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Перейти до змісту</a>
{sprite}

{conv(header)}
''')

    footer = cut(home_html, '<footer class="foot"', '</footer>')
    footer = re.sub(r'<nav class="foot-links" aria-label="Розділи">.*?</nav>', '<nav class="foot-links" aria-label="Розділи"><?php enray_footer_links(); ?></nav>', footer, flags=re.S)
    footer = footer.replace('<a href="mailto:enray@ukr.net">enray@ukr.net</a>', "<a href=\"<?php echo esc_attr( 'mailto:' . enray_opt( 'email' ) ); ?>\"><?php echo esc_html( enray_opt( 'email' ) ); ?></a>")
    footer = footer.replace('<span>м. Вінниця, вул. Стрілецька, 16 А</span>', "<span><?php echo esc_html( enray_opt( 'address' ) ); ?></span>")
    footer = footer.replace('<span>09:00–18:00</span>', "<span><?php echo esc_html( enray_opt( 'hours' ) ); ?></span>")
    footer = footer.replace('<span>© 2026 EnRay</span>', "<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> EnRay</span>")
    footer = footer.replace('href="#top" aria-label="EnRay, на початок сторінки"', f'href="{home()}" aria-label="EnRay, на головну"')
    mbar = cut(home_html, '<nav class="mobile-bar"', '</nav>')
    open(os.path.join(OUT, 'footer.php'), 'w', encoding='utf-8').write(f'''<?php
/** Футер-картка і нижня панель зв'язку. Згенеровано enray-v2/tools/build_wp.py. */
?>
{conv(footer)}

{conv(mbar)}

<?php wp_footer(); ?>
</body>
</html>
''')

    # головна: перший екран + аркуш
    body = cut(home_html, '<section class="hero" id="top"', '</main>')
    body = conv(forms(body, 'home'))
    open(os.path.join(OUT, 'front-page.php'), 'w', encoding='utf-8').write(
        "<?php\n/** Головна. Розмітка з enray-v2/index.html (build_wp.py). */\nget_header();\n?>\n" + body + "\n<?php\nget_footer();\n")

    # сценарії
    for proto, slug, key in [('dim', 'dim', 'dim'), ('biz', 'biznes', 'biznes')]:
        h = read(os.path.join(V2, proto, 'index.html'))
        body = conv(forms(cut(h, '<main id="main"', '</main>'), key))
        open(os.path.join(OUT, f'page-{slug}.php'), 'w', encoding='utf-8').write(
            f"<?php\n/** Сторінка сценарію «{slug}». Розмітка з enray-v2/{proto}/ (build_wp.py). */\nget_header();\n?>\n" + body + "\n<?php\nget_footer();\n")

    # послуги: вміст <main> у services/<slug>.php, обгортка — page-service.php
    os.makedirs(os.path.join(OUT, 'services'))
    for p in sorted(glob.glob(os.path.join(V2, 'posluhy', '*', 'index.html'))):
        slug = os.path.basename(os.path.dirname(p))
        h = read(p)
        inner = cut(h, '<main id="main" class="sheet sheet--page">', '</main>', False)[len('<main id="main" class="sheet sheet--page">'):]
        open(os.path.join(OUT, 'services', slug + '.php'), 'w', encoding='utf-8').write(
            f"<?php\n/** Послуга «{slug}». Згенеровано enray-v2/tools/build_wp.py з enray-v2/posluhy/{slug}/. */\n?>\n" + editors_only(conv(forms(inner, 'service'))))
    open(os.path.join(OUT, 'page-service.php'), 'w', encoding='utf-8').write('''<?php
/** Сторінка послуги: вміст із services/<slug>.php, шапка й футер — спільні. */
get_header();
?>
<main id="main" class="sheet sheet--page">
<?php require get_template_directory() . '/services/' . enray_current_service() . '.php'; ?>
</main>
<?php
get_footer();
''')

    # functions.php: стилі й скрипти v2, колір теми, версія
    f = read(os.path.join(OUT, 'functions.php'))
    f = f.replace("define( 'ENRAY_VERSION', '1.0.0' );", "define( 'ENRAY_VERSION', '2.2.1' );")
    a = f.index("add_action( 'wp_enqueue_scripts', function () {")
    b = f.index('} );', a) + 4
    f = f[:a] + '''add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'enray-fonts', enray_asset( 'css/fonts.css' ), array(), ENRAY_VERSION );
	wp_enqueue_style( 'enray', enray_asset( 'css/v2.css' ), array( 'enray-fonts' ), ENRAY_VERSION );
	if ( ! is_front_page() ) {
		wp_enqueue_style( 'enray-page', enray_asset( 'css/page.css' ), array( 'enray' ), ENRAY_VERSION );
	}
	wp_enqueue_style( 'enray-wp', enray_asset( 'css/wp.css' ), array( 'enray' ), ENRAY_VERSION );
	wp_enqueue_script( 'enray', enray_asset( 'js/main.js' ), array(), ENRAY_VERSION, array( 'strategy' => 'defer' ) );
	if ( enray_current_scenario() ) {
		wp_enqueue_script( 'enray-scenario', enray_asset( 'js/scenario.js' ), array( 'enray' ), ENRAY_VERSION, array( 'strategy' => 'defer' ) );
	}
	wp_enqueue_script( 'enray-v2', enray_asset( 'js/v2.js' ), array( 'enray' ), ENRAY_VERSION, array( 'strategy' => 'defer' ) );
} );''' + f[b:]
    f = f.replace("content=\"#dcedfd\"", "content=\"#f2f4f7\"")
    f = f.replace('EnRay 2026: налаштування теми.', 'EnRay 2026 v2: налаштування теми (основа — тема enray-2026, стиль — enray-v2).')
    # Напрямок «полив» прибрано: агрокомпанії входять у «Для бізнесу»
    f = '\n'.join(l for l in f.split('\n') if "'agro'" not in l and "/agro/" not in l and "cf7_agro" not in l)
    f = f.replace('для дому, бізнесу й поливу', 'для дому й бізнесу, зокрема агропідприємств')
    open(os.path.join(OUT, 'functions.php'), 'w', encoding='utf-8').write(f)
    p404 = os.path.join(OUT, '404.php')
    open(p404, 'w', encoding='utf-8').write('\n'.join(l for l in read(p404).split('\n') if '/agro/' not in l))
    os.remove(os.path.join(OUT, 'cf7', 'agro.txt'))
    ph = os.path.join(OUT, 'cf7', 'home.txt')
    open(ph, 'w', encoding='utf-8').write(read(ph).replace(' "Станція для поливу"', '').replace('pick--6', 'pick--5'))

    open(os.path.join(OUT, 'style.css'), 'w', encoding='utf-8').write('''/*
Theme Name: EnRay 2026 v2
Theme URI: https://enray.com.ua/
Author: EnRay
Description: Нова редакція сайту EnRay: реальне фото станції на першому екрані, скляне меню, фотокартки зі скосом пластини знака, шлях сонця й енергетичний градієнт (див. enray-v2/DESIGN.md). Стилі лежать у assets/css, цей файл лише заголовок теми.
Version: 2.2.1
Requires at least: 6.4
Requires PHP: 7.4
Text Domain: enray
*/
''')
    shutil.copy(os.path.join(V2, 'tools', 'wp.css'), os.path.join(OUT, 'assets', 'css', 'wp.css'))
    print('theme written to', os.path.relpath(OUT, REPO))


if __name__ == '__main__':
    main()
