#!/usr/bin/env python3
"""Внутрішні сторінки EnRay v2 зі спільної оболонки.

Шапка, іконки, футер і нижня панель беруться з enray-v2/index.html (головна — джерело правди).
Вміст і логіку сценаріїв (графіки, калькулятори, FAQ, форми) беремо з першої версії enray/<slug>/,
щоб тексти й чесні правила даних лишались тими самими.
Запуск з кореня репозиторію: python3 enray-v2/tools/build_pages.py
"""
import os
import re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
REPO = os.path.dirname(ROOT)
TEL = 'tel:+380676722244'
VIBER = 'viber://chat?number=%2B380676722244'


def read(p):
    return open(p, encoding='utf-8').read()


def cut(s, a, b, inc=True):
    i = s.index(a)
    j = s.index(b, i) + (len(b) if inc else 0)
    return s[i:j]


def I(n):
    return f'<svg class="ico" aria-hidden="true"><use href="#{n}"/></svg>'


def shell():
    home = read(os.path.join(ROOT, 'index.html'))
    sprite = cut(home, '<svg width="0" height="0"', '</svg>')
    sprite = sprite.replace('</svg>', '  <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>\n</svg>')

    def sub(x):
        x = re.sub(r'href="#top"', 'href="../"', x)
        # розділи головної → ../#розділ; заявка лишається на сторінці; іконки (#i-…) не чіпаємо
        x = re.sub(r'href="#(?!zayavka|i-)([\w-]+)"', r'href="../#\1"', x)
        x = x.replace('src="assets/', 'src="../assets/')
        return x.replace('aria-label="EnRay, на початок сторінки"', 'aria-label="EnRay, на головну"')
    return dict(
        sprite=sprite,
        header=sub(cut(home, '<header class="top">', '</header>')),
        footer=sub(cut(home, '<footer class="foot"', '</footer>')),
        mbar=cut(home, '<nav class="mobile-bar"', '</nav>'),
    )


def steps_from(v1):
    rows = re.findall(r'<li><span class="step-n">(\d+)</span><b>([^<]+)</b><span>([^<]+)</span></li>', v1)
    return ''.join(f'        <li><span class="step-n">{n}</span><h3>{b}</h3><p>{t[0].upper() + t[1:]}.</p></li>\n' for n, b, t in rows)


def gallery(items, label):
    lis = ''.join(f'      <li><img src="../assets/img/{f}" alt="{alt}" loading="lazy" decoding="async"><span>{cap}</span></li>\n' for f, alt, cap in items)
    return f'    <ul class="gallery" aria-label="{label}">\n{lis}    </ul>'


def page(sh, p, body):
    return f'''<!doctype html>
<html lang="uk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{p['title']}</title>
<meta name="description" content="{p['desc']}">
<meta name="theme-color" content="#f2f4f7">
<link rel="icon" href="../assets/img/logo-mark.png">
<link rel="preload" href="../assets/fonts/Onest-var-cyrillic.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="../assets/css/fonts.css">
<link rel="stylesheet" href="../assets/css/v2.css">
<link rel="stylesheet" href="../assets/css/page.css">
</head>
<body class="page">
<a class="skip" href="#main">Перейти до змісту</a>
{sh['sprite']}

{sh['header']}

<main id="main" class="sheet sheet--page">
  <div class="rings" aria-hidden="true"></div>

  <section class="phero" aria-labelledby="hero-h">
    <img class="phero-photo" src="../assets/img/{p['hero_img']}" width="{p.get('hero_w', 1280)}" height="{p['hero_h']}" alt="{p['hero_alt']}" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="../">Головна</a><span aria-hidden="true">/</span><span>{p['crumb']}</span></p>
      <h1 id="hero-h">{p['h1']}</h1>
      <p class="phero-sub">{p['sub']}</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="{p['cta'][1]}">{p['cta'][0]}</a>
        <a class="btn btn-glass btn-lg" href="{TEL}">{I('i-phone')}Подзвонити</a>
      </div>
    </div>
  </section>

{body}

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">{p['steps_h']}</h2>
    <ol class="timeline">
{p['steps']}    </ol>
  </section>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">{p['faq_h']}</h2>
    {p['faq']}
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">{p['req_h']}</h2>
      <p class="lead">{p['req_lead']}</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="{TEL}">+38 067 672 22 44</a>
      <a class="btn btn-viber" href="{VIBER}">{I('i-viber')}Написати у Viber</a>
    </div>
    <div class="req-card">
      {p['form']}
    </div>
  </section>
</main>

{sh['footer']}

{sh['mbar']}

<script src="../assets/js/main.js" defer></script>
<script src="../assets/js/scenario.js" defer></script>
<script src="../assets/js/v2.js" defer></script>
</body>
</html>
'''


def common(v1):
    return dict(
        steps=steps_from(v1),
        faq=cut(v1, '<div class="faq-list">', '</div>\n  </section>', False),
        form=cut(v1, '<form class="request-form"', '</form>'),
    )


def build_dim(sh):
    v1 = read(os.path.join(REPO, 'enray', 'dim', 'index.html'))
    loads = cut(v1, '<fieldset class="loads">', '</fieldset>')
    loads = re.sub(r'<label class="load">(<input) type="checkbox"([^>]*>)', r'<label class="load">\1 class="load-input" type="checkbox"\2<span class="load-box">' + I('i-check').replace('\\', '\\\\') + '</span>', loads)
    result = cut(v1, '<div class="rezerv-result" aria-live="polite">', '</a>') + '\n      </div>'
    body = f'''  <section class="day" aria-labelledby="day-h">
    <div class="sec-head">
      <h2 id="day-h">Як змінюється доба зі станцією</h2>
      <p class="lead">Перемкніть і порівняйте: та сама доба з&nbsp;відключеннями без станції й&nbsp;зі станцією.</p>
    </div>
    {cut(v1, '<figure class="day-panel" id="doba">', '</figure>')}
  </section>

  <section class="rezerv" id="rezerv" aria-labelledby="rezerv-h">
    <div class="sec-head">
      <h2 id="rezerv-h">Що має працювати, коли мережі немає</h2>
      <p class="lead">Позначте прилади. Порахуємо енергію на нічні відключення з&nbsp;прикладу (8 годин) і&nbsp;орієнтир ємності акумулятора.</p>
    </div>
    <div class="rezerv-grid">
      {loads}
      {result}
    </div>
  </section>

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Як це виглядає на даху</h2>
      <p class="lead">Дахова станція 6&nbsp;кВт, яку ми змонтували за тиждень.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="../assets/img/dim-case.webp" width="1200" height="750" alt="Сонячні панелі на даху цегляного будинку: станція EnRay 6 кВт у Вінницькій області" loading="lazy" decoding="async">
        <figcaption>Дахова СЕС 6&nbsp;кВт · Вінницька обл. · 2024</figcaption>
      </figure>
      <div class="cf-side">
        {cut(v1, '<dl class="cf-spec">', '</dl>')}
        <figure class="cf-inverter">
          <img src="../assets/img/dim-inverter.webp" width="800" height="800" alt="Інвертор і електрощиток станції 6 кВт у будинку" loading="lazy" decoding="async">
          <figcaption>Інвертор і щиток у будинку, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
{gallery([('roof-b1.webp', 'Дахова сонячна станція на приватному будинку', 'Дахова СЕС · 2024'), ('dim-g2.webp', 'Сонячні панелі на двосхилому даху', 'Дахова СЕС · 2024'), ('dim-g3.webp', 'Панелі на червоній металочерепиці', 'Дахова СЕС · 2024'), ('dim-g4.webp', 'Панелі на плоскому даху, вигляд з дрона', 'Дахова СЕС · 2024')], 'Інші дахові станції EnRay, 2024')}
  </section>'''
    p = dict(common(v1),
             title='Сонячна станція для дому з резервом на відключення | EnRay',
             desc='Гібридна сонячна станція для приватного будинку у Вінницькій області: світло, котел, холодильник та інтернет під час відключень. Проєкт, монтаж і підключення від EnRay.',
             hero_img='dim-hero.webp', hero_h=960, hero_alt='Сонячна станція EnRay на даху приватного будинку',
             crumb='Для дому', h1='Світло вдома, навіть коли за&nbsp;вікном графік',
             sub='Гібридна сонячна станція з&nbsp;акумулятором для приватного будинку у&nbsp;Вінницькій області.',
             cta=('Порахувати резерв', '#rezerv'), steps_h='Від дзвінка до світла в&nbsp;будинку',
             faq_h='Питання власників будинків', req_h='Розрахунок для вашого будинку',
             req_lead='Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, з&nbsp;попереднім розрахунком потужності й&nbsp;ємності акумулятора.')
    return page(sh, p, body)


def build_biz(sh):
    v1 = read(os.path.join(REPO, 'enray', 'biz', 'index.html'))
    panel = cut(v1, '<figure class="day-panel bill-panel">', '</figure>')
    inputs = cut(v1, '<div class="biz-inputs">', '</fieldset>') + '\n      </div>'
    result = cut(v1, '<div class="rezerv-result" aria-live="polite">', '</a>') + '\n      </div>'
    spec = cut(v1, '<dl class="cf-spec">', '</dl>')
    note = cut(v1, '<p class="cf-note">', '</p>')
    body = f'''  <section class="day" aria-labelledby="bill-h">
    <div class="sec-head">
      <h2 id="bill-h">Скільки з рахунку закриє станція</h2>
      <p class="lead">Рахунок за рік по місяцях без станції й&nbsp;зі станцією. Графік перерахується, щойно ви введете свої дані нижче.</p>
    </div>
    {panel}
  </section>

  <section class="rezerv" id="kalkulyator" aria-labelledby="calc-h">
    <div class="sec-head">
      <h2 id="calc-h">Порахуйте для свого бізнесу</h2>
      <p class="lead">Введіть свій рахунок і&nbsp;тариф. Обидва графіки на сторінці перерахуються за вашими даними.</p>
    </div>
    <div class="rezerv-grid">
      {inputs}
      {result}
    </div>
  </section>

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Наша станція в&nbsp;Ладижині</h2>
      <p class="lead">Наземна мережева станція 30&nbsp;кВт, змонтована за тиждень.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="../assets/img/case-2.webp" width="800" height="500" alt="Наземна мережева сонячна станція 30 кВт у Ладижині, змонтована EnRay у 2026 році" loading="lazy" decoding="async">
        <figcaption>Наземна СЕС 30&nbsp;кВт · Ладижин · 2026</figcaption>
      </figure>
      <div class="cf-side">
        {spec}
        {note}
        <figure class="cf-inverter">
          <img src="../assets/img/biz-detail.webp" width="800" height="600" alt="Інвертор і щиток захисту на стійках під панелями станції в Ладижині" loading="lazy" decoding="async">
          <figcaption>Інвертор і щиток під панелями, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
{gallery([('biz-g1.webp', 'Ряд панелей наземної станції в Ладижині', 'Ладижин · 30 кВт · 2026'), ('biz-g2.webp', 'Конструкція наземної станції в Ладижині, вигляд знизу', 'Ладижин · конструкція'), ('biz-g3.webp', 'Наземна сонячна станція біля сільського будинку, вигляд з дрона', 'Наземна СЕС · 2026'), ('biz-g4.webp', 'Ряди панелей наземної станції на ділянці', 'Наземна СЕС · 2026')], 'Наземні станції EnRay, 2026')}
  </section>'''
    p = dict(common(v1),
             title=re.search(r'<title>(.*?)</title>', v1).group(1),
             desc=re.search(r'<meta name="description" content="([^"]*)"', v1).group(1),
             hero_img='biz-hero.webp', hero_h=720, hero_alt='Ряд панелей наземної сонячної станції EnRay 30 кВт у Ладижині',
             crumb='Для бізнесу', h1='Менший рахунок за&nbsp;світло для&nbsp;бізнесу',
             sub='Мережеві й гібридні сонячні станції на даху чи на землі для підприємств, магазинів, складів і&nbsp;агрокомпаній у&nbsp;Вінницькій області: проєкт, монтаж і&nbsp;підключення до мережі.',
             cta=('Порахувати економію', '#kalkulyator'), steps_h=re.search(r'<h2 id="steps-h">(.*?)</h2>', v1).group(1),
             faq_h=re.search(r'<h2 id="faq-h">(.*?)</h2>', v1).group(1), req_h='Розрахунок для вашого бізнесу',
             req_lead='Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, і&nbsp;попросить рахунки за рік, щоб порахувати потужність та економію точно.')
    return page(sh, p, body)


def build_agro(sh):
    v1 = read(os.path.join(REPO, 'enray', 'agro', 'index.html'))
    panel = cut(v1, '<figure class="day-panel bill-panel">', '</figure>')
    inputs = cut(v1, '<div class="biz-inputs">', '\n      <div class="rezerv-result"', False)
    result = cut(v1, '<div class="rezerv-result" aria-live="polite">', '</a>') + '\n      </div>'
    spec = cut(v1, '<dl class="cf-spec">', '</dl>')
    note = cut(v1, '<p class="cf-note">', '</p>')
    body = f'''  <section class="day" aria-labelledby="season-h">
    <div class="sec-head">
      <h2 id="season-h">Скільки енергії потрібно насосам за сезон</h2>
      <p class="lead">Енергія насосів по місяцях сезону поливу без станції й&nbsp;зі станцією. Графік перерахується за вашими даними нижче.</p>
    </div>
    {panel}
  </section>

  <section class="rezerv" id="kalkulyator" aria-labelledby="calc-h">
    <div class="sec-head">
      <h2 id="calc-h">Порахуйте для своїх насосів</h2>
      <p class="lead">Вкажіть насоси й сезон. Обидва графіки на сторінці перерахуються за вашими даними.</p>
    </div>
    <div class="rezerv-grid">
      {inputs}
      {result}
    </div>
  </section>

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Полив саду в&nbsp;Луці-Мелешківській</h2>
      <p class="lead">Станція 100&nbsp;кВт для поливу саду, змонтована за 10&nbsp;днів.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="../assets/img/agro-detail.webp" width="800" height="600" alt="Ряди сонячних панелей станції 100 кВт на даху господарської будівлі поруч із садом у селі Лука-Мелешківська" loading="lazy" decoding="async">
        <figcaption>СЕС 100&nbsp;кВт · Лука-Мелешківська · 2025</figcaption>
      </figure>
      <div class="cf-side">
        {spec}
        {note}
      </div>
    </div>
  </section>'''
    p = dict(common(v1),
             title=re.search(r'<title>(.*?)</title>', v1).group(1),
             desc=re.search(r'<meta name="description" content="([^"]*)"', v1).group(1),
             hero_img='hero-1800.webp', hero_w=1800, hero_h=977, hero_alt='Сонячна станція EnRay 100 кВт на даху господарської будівлі біля водойми для поливу саду',
             crumb='Для поливу', h1='Енергія для поливу просто з&nbsp;поля',
             sub='Сонячні станції для насосів і&nbsp;поливу у&nbsp;Вінницькій області, зокрема автономні, там, де немає мережі.',
             cta=('Порахувати для насосів', '#kalkulyator'), steps_h=re.search(r'<h2 id="steps-h">(.*?)</h2>', v1).group(1),
             faq_h=re.search(r'<h2 id="faq-h">(.*?)</h2>', v1).group(1), req_h='Розрахунок для вашого поливу',
             req_lead='Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, і&nbsp;попросить дані насосів, щоб підібрати потужність станції.')
    return page(sh, p, body)


# Напрямок «полив» прибрано: агрокомпанії входять у «Для бізнесу». Тексти першої редакції чистимо тут.
SCRUB = [
    ('станцію 100 кВт для поливу саду в Луці-Мелешківській', 'станцію 100 кВт у Луці-Мелешківській'),
    ('Станція для поливу саду', 'Наземна станція 100 кВт'),
]


def scrub(h):
    for a, b in SCRUB:
        h = h.replace(a, b)
    return h


def main():
    sh = shell()
    for slug, fn in [('dim', build_dim), ('biz', build_biz)]:
        d = os.path.join(ROOT, slug)
        os.makedirs(d, exist_ok=True)
        open(os.path.join(d, 'index.html'), 'w', encoding='utf-8').write(scrub(fn(sh)))
        print('ok', slug)



# ---------------- Сторінки послуг (дані — enray/tools/build_services.py) ----------------

SVC_SLUGS = ['proiektuvannia', 'budivnytstvo', 'obsluhovuvannia', 'electrical-works', 'systemy-okhorony-ta-bezpeky', 'videosposterezhennia-cctv']
SVC_VISUAL = {  # фото першого екрана або синя картка з іконкою, де власних фото поки немає
    'proiektuvannia': ('img', 'roof-e2.webp', 1100, 825, 'Сонячна станція EnRay на даху приватного будинку'),
    'budivnytstvo': ('img', 'lad-2.webp', 1100, 619, 'Наземна станція EnRay 30 кВт у Ладижині'),
    'obsluhovuvannia': ('img', 'roof-f2.webp', 1100, 613, 'Дахова сонячна станція EnRay, вигляд з дрона'),
    'electrical-works': ('icon', 'i-bolt'),
    'systemy-okhorony-ta-bezpeky': ('icon', 'i-shield'),
    'videosposterezhennia-cctv': ('icon', 'i-camera'),
}
TODO = '<span class="todo">уточнити</span>'


def services_data():
    import importlib.util
    spec = importlib.util.spec_from_file_location('bs', os.path.join(REPO, 'enray', 'tools', 'build_services.py'))
    m = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(m)
    return m.SERVICES, m.SHORT


def esc(s):
    import html
    return html.escape(s, quote=False)


def deepen(x):
    """Шапка й футер для сторінок на два рівні глибше (posluhy/<slug>/)."""
    x = x.replace('href="../', 'href="../../').replace('src="../', 'src="../../')
    return x


def build_service(sh, slug, S, SHORT):
    s = S[slug]
    vis = SVC_VISUAL[slug]
    if vis[0] == 'img':
        media = f'<img class="phero-photo" src="../../assets/img/{vis[1]}" width="{vis[2]}" height="{vis[3]}" alt="{vis[4]}" fetchpriority="high">'
        art = ''
    else:
        media = f'<span class="phero-art" aria-hidden="true">{I(vis[1])}</span>'
        art = ' phero--art'
    todo_cls = ' class="is-todo"'
    rows = ''.join(
        f'<div{todo_cls if v is None else ""}><dt>{esc(k)}</dt><dd>{TODO if v is None else esc(v)}</dd></div>'
        for k, v in s['stamp'])
    cta_href = s['cta'][1].replace('home', '../../')
    inc = ''.join(f'<li class="inc"><h3>{esc(h)}</h3><ul>{"".join(f"<li>{esc(i)}</li>" for i in items)}</ul></li>' for h, items in s['includes'])
    steps = ''.join(f'        <li><span class="step-n">{i:02d}</span><h3>{esc(b)}</h3><p>{esc(t[0].upper() + t[1:])}.</p></li>\n' for i, (b, t) in enumerate(s['steps'], 1))
    if s['photos']:
        lis = ''.join(f'      <li><img src="../../assets/img/{f}" alt="{esc(a)}" loading="lazy" decoding="async"><span>{esc(c)}</span></li>\n' for f, a, c in s['photos'])
        works = f'    <ul class="gallery" aria-label="Роботи EnRay">\n{lis}    </ul>'
    else:
        works = '    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об\'єктах. Стокові фото не ставимо.</p>'
    faq = ''.join(f'      <details><summary>{esc(q)}{I("i-plus")}</summary><p>{TODO if a is None else esc(a)}</p></details>\n' for q, a in s['faq'])
    others = ''.join(
        f'<li><a class="svc-link" href="../{o}/"><span class="svc-link-name">{esc(S[o]["name"])}</span><span class="svc-link-what">{esc(SHORT[o])}</span>{I("i-arrow")}</a></li>'
        for o in SVC_SLUGS if o != slug)
    task = s.get('form_task', 'Що потрібно зробити')
    form = f'''<form class="request-form" id="request-form" method="post" action="#" novalidate>
        <input type="hidden" name="service" value="{esc(s['form_service'])}">
        <p class="form-req"><span class="req" aria-hidden="true">*</span> — обов'язкові поля, решта за бажанням.</p>
        <div class="field"><label for="f-name">Ім'я <span class="req" aria-hidden="true">*</span></label><input id="f-name" name="name" type="text" autocomplete="name" maxlength="60" required></div>
        <div class="field"><label for="f-phone">Телефон <span class="req" aria-hidden="true">*</span></label><input id="f-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" maxlength="20" placeholder="+38 067 123 45 67" required></div>
        <div class="field field--wide"><label for="f-place">Населений пункт</label><input id="f-place" name="place" type="text" autocomplete="address-level2" maxlength="80"></div>
        <div class="field field--wide"><label for="f-task">{esc(task)}</label><textarea id="f-task" name="task" rows="3" maxlength="500"></textarea></div>
        <p class="form-errors" id="form-errors" role="alert" hidden></p>
        <button class="btn btn-primary btn-lg" type="submit">Надіслати запит</button>
        <p class="form-msg" id="form-msg" role="status"></p>
        <p class="form-next">Інженер передзвонить, уточнить задачу й домовиться про виїзд. Дані з форми використовуємо лише для зв'язку з вами: <a href="https://enray.com.ua/privacy-policy/">політика конфіденційності</a>.</p>
      </form>'''
    return f'''<!doctype html>
<html lang="uk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{esc(s['title'])}</title>
<meta name="description" content="{esc(s['desc'])}">
<meta name="theme-color" content="#f2f4f7">
<link rel="icon" href="../../assets/img/logo-mark.png">
<link rel="preload" href="../../assets/fonts/Onest-var-cyrillic.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="../../assets/css/fonts.css">
<link rel="stylesheet" href="../../assets/css/v2.css">
<link rel="stylesheet" href="../../assets/css/page.css">
</head>
<body class="page">
<a class="skip" href="#main">Перейти до змісту</a>
{sh['sprite']}

{deepen(sh['header'])}

<main id="main" class="sheet sheet--page">
  <div class="rings" aria-hidden="true"></div>

  <section class="phero phero--svc{art}" aria-labelledby="hero-h">
    {media}
    <div class="phero-copy">
      <p class="crumbs"><a href="../../">Головна</a><span aria-hidden="true">/</span><a href="../../#posluhy">Послуги</a><span aria-hidden="true">/</span><span>{esc(s['crumb'])}</span></p>
      <h1 id="hero-h">{s['h1']}</h1>
      <p class="phero-sub">{esc(s['lead'])}</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="{cta_href}">{esc(s['cta'][0])}</a>
        <a class="btn btn-glass btn-lg" href="{TEL}">{I('i-phone')}Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">{esc(s['name'])}</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">{rows}</dl>
    </figure>
  </section>

  <section class="includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <ul class="inc-grid">{inc}</ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">{esc(s['steps_h'])}</h2>
    <ol class="timeline">
{steps}    </ol>
  </section>

  <section class="works" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
{works}
  </section>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про {esc(s['crumb'].lower())}</h2>
    <div class="faq-list">
{faq}    </div>
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">{esc(s['form_h'])}</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="{TEL}">+38 067 672 22 44</a>
      <a class="btn btn-viber" href="{VIBER}">{I('i-viber')}Написати у Viber</a>
    </div>
    <div class="req-card">
      {form}
    </div>
  </section>

  <section class="others" aria-labelledby="oth-h">
    <h2 id="oth-h">Інші послуги</h2>
    <ul class="svc-links">{others}</ul>
  </section>
</main>

{deepen(sh['footer'])}

{sh['mbar']}

<script src="../../assets/js/main.js" defer></script>
<script src="../../assets/js/v2.js" defer></script>
</body>
</html>
'''


def build_services():
    sh = shell()
    S, SHORT = services_data()
    for slug in SVC_SLUGS:
        d = os.path.join(ROOT, 'posluhy', slug)
        os.makedirs(d, exist_ok=True)
        open(os.path.join(d, 'index.html'), 'w', encoding='utf-8').write(scrub(build_service(sh, slug, S, SHORT)))
        print('ok posluhy/' + slug)


if __name__ == '__main__':
    main()
    build_services()
