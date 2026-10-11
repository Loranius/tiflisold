#!/usr/bin/env python3
"""Сторінки послуг EnRay з одного джерела.

Генерує:
  enray/posluhy/<slug>/index.html               — сторінки прототипу;
  enray/wp-theme/enray-2026/services/<slug>.php — вміст <main> для теми WordPress.

Склад робіт узято з власних сторінок послуг enray.com.ua. Значення None — прогалина:
у прототипі видно позначку «уточнити», у WordPress такий рядок бачать лише редактори.
Запуск з кореня репозиторію: python3 enray/tools/build_services.py
"""
import html
import os
import re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
TODO = None  # прогалина, яку заповнить компанія

GROUPS = [
    ('Сонячна енергетика', 'i-sun', ['proiektuvannia', 'budivnytstvo', 'obsluhovuvannia']),
    ('Електрика й безпека', 'i-bolt', ['electrical-works', 'systemy-okhorony-ta-bezpeky', 'videosposterezhennia-cctv']),
]

SOLAR_STEPS = [
    ('Виїзд', 'огляд даху чи ділянки, заміри'),
    ('Проєкт', 'розрахунок генерації, підбір обладнання'),
    ('Постачання', "обладнання на об'єкт"),
    ('Монтаж', '7–10 днів для станцій 6–100 кВт'),
    ('Підключення', 'документи, обленерго, сервіс після запуску'),
]

SERVICES = {
    'proiektuvannia': dict(
        name='Проєктування СЕС', crumb='Проєктування',
        title='Проєктування сонячних станцій у Вінницькій області | EnRay',
        desc='Проєктування сонячних електростанцій 6–100 кВт: виїзд і заміри, оцінка даху чи ділянки й підключення до мережі, проєкт під ваше споживання. EnRay, Вінниця.',
        h1='Проєкт сонячної станції під ваше спожи&shy;вання',
        lead='Виїзд і заміри, оцінка даху чи ділянки й можливості підключення до мережі, підбір обладнання під ваші рахунки.',
        cta=('Порахувати потужність', 'home#kalkulyator'),
        stamp=[
            ('Станції', 'дахові й наземні, 6–100 кВт'),
            ('Територія', 'Вінниця й область'),
            ('Що потрібно від вас', 'рахунки за електроенергію за рік'),
            ('Вартість проєкту', TODO),
            ('Строк підготовки', TODO),
        ],
        includes=[
            ('Виїзд на об\'єкт', ['заміри даху або ділянки', 'збір даних для проєкту', 'оцінка місця для інвертора й щита']),
            ('Аналіз місця', ['орієнтація й рельєф', 'кліматичні умови й сонячна радіація', 'оптимальне розміщення панелей']),
            ('Підключення до мережі', ['технічні можливості підключення', 'юридичні вимоги й документи']),
            ('Проєкт', ['потужність і склад обладнання під ваше споживання', 'схема розміщення й підключення']),
        ],
        steps=SOLAR_STEPS, steps_h='Від виїзду до запуску станції',
        photos=[('dim-g2.webp', 'Сонячні панелі на двосхилому даху приватного будинку', 'Дахова СЕС · 2024'),
                ('biz-g1.webp', 'Наземна станція 30 кВт у Ладижині', 'Наземна СЕС 30 кВт · 2026'),
                ('agro-detail.webp', 'Станція для поливу саду', 'СЕС 100 кВт · 2025'),
                ('dim-g4.webp', 'Панелі на плоскому даху, вигляд з дрона', 'Дахова СЕС · 2024')],
        faq=[
            ('Що потрібно від мене для проєкту?', 'Рахунки за електроенергію за рік і доступ до даху чи ділянки. За рахунками інженер рахує потужність, а на місці перевіряє, де стануть панелі й інвертор.'),
            ('Скільки коштує проєкт?', TODO),
            ('Чи можна замовити лише проєкт, без монтажу?', TODO),
        ],
        form_h='Заявка на проєкт станції', form_service='Проєктування СЕС',
    ),
    'budivnytstvo': dict(
        name='Будівництво СЕС', crumb='Будівництво',
        title='Будівництво сонячних станцій під ключ у Вінницькій області | EnRay',
        desc='Будівництво дахових і наземних сонячних станцій 6–100 кВт під ключ: кріплення, панелі, інвертор і акумулятори, підключення. Монтаж 7–10 днів. EnRay, Вінниця.',
        h1='Будуємо сонячні станції під ключ',
        lead='Дахові й наземні станції 6–100 кВт: кріплення, панелі, інвертор і акумулятори, підключення й налагодження. Монтаж — 7–10 днів.',
        cta=('Порахувати потужність', 'home#kalkulyator'),
        stamp=[
            ('Станції', 'дахові й наземні, мережеві й гібридні'),
            ('Потужність', '6–100 кВт'),
            ('Монтаж', '7–10 днів'),
            ('Документи й підключення', 'беремо на себе'),
            ('Вартість', TODO),
            ('Гарантія на роботи', TODO),
        ],
        includes=[
            ('Підготовка', ['огляд покрівлі чи ділянки', 'перевірка міцності даху', 'підготовка території для наземної станції']),
            ('Конструкції', ['кріплення під тип покрівлі', 'опори для наземних станцій']),
            ('Монтаж обладнання', ['панелі з правильним кутом і орієнтацією', 'інвертор, акумулятори, щит', 'кабелі й захист']),
            ('Запуск', ['перевірка всіх вузлів', 'налаштування інвертора', 'перевірка генерації']),
        ],
        steps=SOLAR_STEPS, steps_h='Від виїзду до запуску станції',
        photos=[('case-3.webp', 'Дахова станція 6 кВт на цегляному будинку', 'Дахова СЕС 6 кВт · 2024'),
                ('case-2.webp', 'Наземна станція 30 кВт у Ладижині', 'Наземна СЕС 30 кВт · 2026'),
                ('case-1.webp', 'Станція 100 кВт на даху господарської будівлі', 'СЕС 100 кВт · 2025'),
                ('biz-g2.webp', 'Ряд панелей наземної станції', 'Наземна СЕС · 2026')],
        faq=[
            ('Скільки триває монтаж?', 'За нашими кейсами 7–10 днів для станцій від 6 до 100 кВт. Точний строк залежить від даху чи ділянки й наявності обладнання.'),
            ('Хто займається документами й підключенням?', 'Ми: технічні умови, договір з обленерго й підключення до мережі. Від вас потрібні підпис і документи на об\'єкт.'),
            ('Скільки коштує станція?', TODO),
        ],
        form_h='Заявка на будівництво станції', form_service='Будівництво СЕС',
    ),
    'obsluhovuvannia': dict(
        name='Обслуговування СЕС', crumb='Обслуговування',
        title='Обслуговування сонячних станцій у Вінницькій області | EnRay',
        desc='Обслуговування сонячних електростанцій: діагностика, чищення панелей, налаштування інвертора, ремонт. EnRay, Вінниця й область.',
        h1='Обслугову&shy;вання сонячних станцій',
        lead='Огляд і діагностика, чищення панелей, налаштування інвертора й ремонт, щоб станція давала стільки енергії, скільки має.',
        cta=('Замовити огляд', '#zayavka'),
        stamp=[
            ('Станції', 'дахові й наземні, мережеві й гібридні'),
            ('Територія', 'Вінниця й область'),
            ('Станції інших монтажників', TODO),
            ('Вартість виїзду й огляду', TODO),
            ('Як швидко приїдемо', TODO),
            ('Гарантія на обладнання', TODO),
        ],
        includes=[
            ('Огляд і діагностика', ['панелі, кабелі, кріплення й з\'єднання', 'інвертор і акумулятори', 'пошук причин нижчої генерації']),
            ('Профілактика', ['чищення панелей від пилу й бруду', 'перевірка конструкцій і кріплень']),
            ('Налаштування', ['параметри інвертора', 'якість з\'єднань', 'моніторинг роботи станції']),
            ('Ремонт', ['заміна несправних деталей', 'оперативний ремонт', 'консультації з експлуатації']),
        ],
        steps=[('Заявка', 'що сталося або коли був останній огляд'), ('Виїзд', 'діагностика на місці'),
               ('Роботи', 'чищення, налаштування або ремонт'), ('Пояснення', 'що зроблено й на що зважати далі')],
        steps_h='Як проходить обслуговування',
        photos=[('dim-inverter.webp', 'Інвертор і електрощиток станції 6 кВт у будинку', 'Інвертор і щиток · 2024'),
                ('biz-detail.webp', 'Кріплення й кабелі наземної станції', 'Наземна СЕС · 2026'),
                ('dim-g1.webp', 'Дахова сонячна станція на приватному будинку', 'Дахова СЕС · 2024'),
                ('biz-g3.webp', 'Панелі наземної станції', 'Наземна СЕС · 2026')],
        faq=[
            ('Що входить у плановий огляд?', 'Перевірка панелей, кабелів і конструкцій, чищення панелей, перевірка інвертора й акумуляторів, аналіз того, скільки енергії дає станція.'),
            ('Як часто обслуговувати станцію?', TODO),
            ('Чи обслуговуєте станції, які ставили інші компанії?', TODO),
        ],
        form_h='Заявка на обслуговування', form_service='Обслуговування СЕС',
        form_task='Що сталося зі станцією',
    ),
    'electrical-works': dict(
        name='Електромонтажні роботи', crumb='Електромонтаж',
        title='Електромонтажні роботи у Вінниці та області | EnRay',
        desc='Електромонтажні роботи у Вінниці та області: проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж для будинків і бізнесу.',
        h1='Електро&shy;монтажні роботи у&nbsp;Вінниці та області',
        lead='Проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація старих мереж для будинків, комерційних і промислових об\'єктів.',
        cta=('Замовити виїзд', '#zayavka'),
        stamp=[
            ('Об\'єкти', 'житлові, комерційні, промислові'),
            ('Територія', 'Вінниця й область'),
            ('Виїзд і огляд', TODO),
            ('Вартість', TODO),
            ('Строки', TODO),
            ('Гарантія на роботи', TODO),
        ],
        includes=[
            ('Проводка', ['розрахунок навантаження', 'проєкт електромережі', 'монтаж і розводка проводки']),
            ('Освітлення', ['внутрішнє й зовнішнє освітлення', 'підключення вимикачів']),
            ('Захист', ['заземлення', 'блискавкозахист', 'захист обладнання від перепадів напруги']),
            ('Автоматизація', ['керування освітленням і енергоспоживанням', 'рішення для «розумного будинку»']),
            ('Ремонт і модернізація', ['діагностика мережі', 'заміна застарілих компонентів', 'оновлення під нові навантаження']),
        ],
        steps=[('Виїзд', 'огляд об\'єкта й мережі'), ('Проєкт', 'схема й кошторис'), ('Монтаж', 'роботи за погодженою схемою'),
               ('Перевірка', 'вимірювання, здача робіт')],
        steps_h='Як проходять роботи',
        photos=None,
        faq=[
            ('Для яких об\'єктів працюєте?', 'Для житлових, комерційних і промислових: від квартири чи будинку до виробничих приміщень.'),
            ('Чи можна замовити лише заземлення або блискавкозахист?', TODO),
            ('Скільки коштує електромонтаж?', TODO),
        ],
        form_h='Заявка на електромонтаж', form_service='Електромонтаж',
        form_task='Що потрібно зробити',
    ),
    'systemy-okhorony-ta-bezpeky': dict(
        name='Системи охорони', crumb='Системи охорони',
        title='Системи охорони та безпеки у Вінниці | EnRay',
        desc='Охоронна й пожежна сигналізація, контроль доступу, захист периметра й відеоспостереження для будинків, офісів і виробництв у Вінниці та області.',
        h1='Системи охорони для дому й бізнесу',
        lead='Охоронна й пожежна сигналізація, контроль доступу, захист периметра й відеоспостереження: проєкт, монтаж і обслуговування.',
        cta=('Замовити огляд об\'єкта', '#zayavka'),
        stamp=[
            ('Об\'єкти', 'будинки, офіси, виробництва'),
            ('Керування', 'з мобільного застосунку'),
            ('Територія', 'Вінниця й область'),
            ('Підключення до пульта охорони', TODO),
            ('Вартість', TODO),
            ('Гарантія', TODO),
        ],
        includes=[
            ('Сигналізація', ['охоронна: виявлення вторгнення', 'пожежна: дим і вогонь', 'оповіщення служб охорони']),
            ('Контроль доступу', ['вхід за карткою, кодом або біометрією', 'облік персоналу й гостей', 'доступ до окремих зон']),
            ('Периметр', ['інфрачервоні датчики', 'датчики руху', 'сповіщення про спробу проникнення']),
            ('Відеоспостереження', ['камери всередині й зовні', 'запис і перегляд з телефона']),
            ('Розумний дім', ['віддалене керування охороною', 'одна система для сигналізації й камер']),
        ],
        steps=[('Огляд', 'об\'єкт, входи, периметр'), ('Проєкт', 'де стануть датчики й камери'),
               ('Монтаж', 'встановлення й налаштування'), ('Передача', 'доступи на телефон і пояснення')],
        steps_h='Як ставимо систему охорони',
        photos=None,
        faq=[
            ('Чи можна об\'єднати сигналізацію з камерами?', 'Так. Сигналізацію, контроль доступу й відеоспостереження інтегруємо в одну систему з керуванням з телефона.'),
            ('Чи можна керувати охороною з телефона?', 'Так, через мобільний застосунок: ставити й знімати з охорони, бачити події в реальному часі.'),
            ('Чи підключаєте сигналізацію до пульта охоронної компанії?', TODO),
        ],
        form_h='Заявка на систему охорони', form_service='Системи охорони',
        form_task="Що охороняти: тип об'єкта, площа",
    ),
    'videosposterezhennia-cctv': dict(
        name='Відеоспостереження', crumb='Відеоспостереження',
        title='Установка відеоспостереження у Вінниці — камери для дому й бізнесу | EnRay',
        desc='Відеоспостереження під ключ у Вінниці та області: підбір і монтаж камер, запис 24/7, перегляд з телефона чи комп\'ютера для дому й бізнесу.',
        h1='Відео&shy;спостереження для дому й бізнесу',
        lead='Підбір і монтаж камер, запис 24/7 і перегляд з телефона чи комп\'ютера: для будинку, офісу, складу або території.',
        cta=('Замовити огляд', '#zayavka'),
        stamp=[
            ('Камери', 'дротові й бездротові, з нічною зйомкою'),
            ('Запис', 'цілодобово, 24/7'),
            ('Перегляд', 'з телефона або комп\'ютера'),
            ('Скільки зберігається запис', TODO),
            ('Вартість', TODO),
            ('Гарантія', TODO),
        ],
        includes=[
            ('Проєкт і монтаж', ['де поставити камери, щоб не було сліпих зон', 'монтаж і налаштування', 'інтеграція з охоронною системою']),
            ('Камери', ['висока роздільна здатність', 'чітке зображення вночі', 'бездротові камери для дому']),
            ('Запис', ['цілодобовий запис 24/7', 'архів для перегляду подій']),
            ('Віддалений доступ', ['перегляд наживо з телефона', 'налаштування камер віддалено']),
        ],
        steps=[('Огляд', 'об\'єкт і зони, які треба бачити'), ('Схема', 'кількість і місця камер'),
               ('Монтаж', 'камери, запис, мережа'), ('Доступ', 'застосунок на вашому телефоні')],
        steps_h='Як встановлюємо камери',
        photos=None,
        faq=[
            ('Чи можна дивитися камери з телефона?', 'Так. Налаштовуємо застосунок: камери видно наживо й у записі з будь-якого місця, де є інтернет.'),
            ('Чи видно щось уночі?', 'Так, ставимо камери, які дають чітке зображення в темряві й при слабкому освітленні.'),
            ('Скільки днів зберігається запис?', TODO),
        ],
        form_h='Заявка на відеоспостереження', form_service='Відеоспостереження',
        form_task='Що треба бачити: будинок, двір, склад, кількість камер',
    ),
}


def esc(s):
    return html.escape(s, quote=False)


class Ctx:
    """Різниця між прототипом і темою: шляхи, посилання й прогалини."""

    def __init__(self, wp):
        self.wp = wp

    def home(self, frag=''):
        return f"<?php echo esc_url( home_url( '/' ) ); ?>{frag}" if self.wp else f'../../index.html{frag}'

    def scen(self, key):
        wp = {'dim': '/dim/', 'biz': '/biznes/', 'agro': '/agro/'}[key]
        return f"<?php echo esc_url( home_url( '{wp}' ) ); ?>" if self.wp else f'../../{key}/'

    def svc(self, slug):
        return f"<?php echo esc_url( home_url( '/{slug}/' ) ); ?>" if self.wp else f'../{slug}/'

    def img(self, f):
        return f"<?php echo esc_url( enray_img( '{f}' ) ); ?>" if self.wp else f'../../assets/plates/{f}'

    def tel(self):
        return '<?php echo esc_attr( enray_tel() ); ?>' if self.wp else 'tel:+380676722244'

    def link(self, target):
        if target.startswith('home'):
            return self.home(target[4:])
        return target

    def gap(self, inner):
        """Блок-прогалина: у темі показуємо лише редакторам."""
        if self.wp:
            return f"<?php if ( current_user_can( 'edit_pages' ) ) : ?>{inner}<?php endif; ?>"
        return inner


TODO_CHIP = '<span class="todo">уточнити</span>'


def render_main(slug, ctx):
    s = SERVICES[slug]
    o = []
    o.append(f'''  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="{ctx.home()}">Головна</a><span aria-hidden="true"> / </span><a href="{ctx.home('#posluhy')}">Послуги</a><span aria-hidden="true"> / </span><span>{esc(s['crumb'])}</span></p>
      <h1 id="hero-h">{s['h1']}</h1>
      <p class="hero-sub">{esc(s['lead'])}</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="{ctx.link(s['cta'][1])}">{esc(s['cta'][0])}</a>
        <a class="btn btn-outline btn-lg" href="{ctx.tel()}">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">{esc(s['name'])}</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
''')
    for label, value in s['stamp']:
        if value is TODO:
            o.append('        ' + ctx.gap(f'<div class="is-todo"><dt>{esc(label)}</dt><dd>{TODO_CHIP}</dd></div>') + '\n')
        else:
            o.append(f'        <div><dt>{esc(label)}</dt><dd>{esc(value)}</dd></div>\n')
    o.append('''      </dl>
    </figure>
  </section>

''')
    o.append('''  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
''')
    for h, items in s['includes']:
        lis = ''.join(f'<li>{esc(i)}</li>' for i in items)
        o.append(f'      <div class="inc"><h3>{esc(h)}</h3><ul>{lis}</ul></div>\n')
    o.append('''    </div>
  </section>

''')
    o.append(f'''  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">{esc(s['steps_h'])}</h2>
    <ol class="steps steps--scenario steps--{len(s['steps'])}">
''')
    for i, (b, t) in enumerate(s['steps'], 1):
        o.append(f'      <li><span class="step-n">{i:02d}</span><b>{esc(b)}</b><span>{esc(t)}</span></li>\n')
    o.append('''    </ol>
  </section>

''')
    if s['photos']:
        o.append('''  <section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <div class="gallery">
''')
        for f, alt, cap in s['photos']:
            o.append(f'      <figure><img src="{ctx.img(f)}" width="800" height="500" alt="{esc(alt)}" loading="lazy"><figcaption>{esc(cap)}</figcaption></figure>\n')
        o.append('''    </div>
  </section>

''')
    else:
        o.append('  ' + ctx.gap('''<section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об'єктах. Стокові фото не ставимо.</p>
  </section>''') + '\n\n')
    o.append(f'''  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про {esc(s['crumb'].lower())}</h2>
    <div class="faq-list">
''')
    for q, a in s['faq']:
        body = f'<details><summary>{esc(q)}<svg class="ico"><use href="#i-plus"/></svg></summary><p>{TODO_CHIP if a is TODO else esc(a)}</p></details>'
        o.append('      ' + (ctx.gap(body) if a is TODO else body) + '\n')
    o.append('''    </div>
  </section>

''')
    task = s.get('form_task', 'Що потрібно зробити')
    if ctx.wp:
        form = f"<?php enray_request_form( 'service', {php_str(s['form_service'])} ); ?>"
    else:
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
    viber = '<?php echo esc_attr( enray_viber() ); ?>' if ctx.wp else 'viber://chat?number=%2B380676722244'
    phone = '<?php echo esc_html( enray_opt( \'phone\' ) ); ?>' if ctx.wp else '+38 067 672 22 44'
    o.append(f'''  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>{esc(s['form_h'])}</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      {form}
    </div>
    <div class="closing-aside">
      <p>Не хочете заповнювати форму? Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p>
      <a class="nav-phone big-phone" href="{ctx.tel()}">{phone}</a>
      <a class="btn btn-viber" href="{viber}"><svg class="ico"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
  </section>

''')
    o.append('''  <section class="section services services--other" aria-labelledby="services-h">
    <h2 id="services-h">Інші послуги</h2>
    <div class="svc-groups">
''')
    for g, ico, slugs in GROUPS:
        o.append(f'''      <div class="svc-group">
        <h3><svg class="ico"><use href="#{ico}"/></svg>{g}</h3>
        <ul class="svc-list">
''')
        for other in slugs:
            if other == slug:
                continue
            so = SERVICES[other]
            o.append(f'          <li><a class="svc" href="{ctx.svc(other)}"><span class="svc-name">{esc(so["name"])}</span><span class="svc-what">{esc(SHORT[other])}</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>\n')
        o.append('''        </ul>
      </div>
''')
    o.append('''    </div>
  </section>
''')
    return ''.join(o)


SHORT = {
    'proiektuvannia': 'виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання',
    'budivnytstvo': 'дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження',
    'obsluhovuvannia': 'діагностика, чищення панелей, налаштування інвертора, ремонт',
    'electrical-works': 'проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж',
    'systemy-okhorony-ta-bezpeky': 'охоронна й пожежна сигналізація, контроль доступу, захист периметра',
    'videosposterezhennia-cctv': 'камери для дому й бізнесу, запис 24/7, перегляд з телефона',
}


def php_str(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"


def proto_page(slug):
    """Повна сторінка прототипу: шапка й футер беремо зі сторінки «Дім» і правимо шляхи."""
    s = SERVICES[slug]
    tpl = open(os.path.join(ROOT, 'dim', 'index.html'), encoding='utf-8').read()
    head_end = tpl.index('<main id="main">')
    foot_start = tpl.index('</main>')
    head, foot = tpl[:head_end], tpl[foot_start:]
    head = re.sub(r'<title>.*?</title>', f'<title>{esc(s["title"])}</title>', head)
    head = re.sub(r'<meta name="description" content="[^"]*">', f'<meta name="description" content="{html.escape(s["desc"])}">', head)
    head = head.replace('<body class="page-scenario">', '<body class="page-scenario page-service">')
    head = head.replace('<link rel="stylesheet" href="../assets/css/scenario.css">',
                        '<link rel="stylesheet" href="../assets/css/scenario.css">\n<link rel="stylesheet" href="../assets/css/service.css">')
    # іконки груп послуг
    sym = ('  <symbol id="i-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2.5M12 19.5V22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M2 12h2.5M19.5 12H22M4.9 19.1l1.8-1.8M17.3 6.7l1.8-1.8"/></symbol>\n'
           '  <symbol id="i-bolt" viewBox="0 0 24 24"><path d="M13 2.5L4.5 13.5H11l-1 8 8.5-11H12l1-8z"/></symbol>\n')
    head = head.replace('  <symbol id="i-arrow"', sym + '  <symbol id="i-arrow"', 1)
    # «Дім» більше не поточна сторінка
    head = head.replace('<a href="./" aria-current="page">Для дому</a>', '<a href="../dim/">Для дому</a>')
    # шляхи шапки й футера сторінки «Дім» — на рівень глибше; вміст <main> уже має свої шляхи
    def deeper(part):
        part = re.sub(r'(href|src)="\.\./', r'\1="../../', part)
        part = re.sub(r'<script src="\.\./\.\./assets/js/scenario\.js"[^>]*></script>\s*', '', part)
        for sl in SERVICES:
            part = part.replace(f'href="https://enray.com.ua/{sl}/"', f'href="../{sl}/"')
        return part
    page = deeper(head) + '<main id="main">\n' + render_main(slug, Ctx(False)) + deeper(foot)
    return page


def wp_partial(slug):
    s = SERVICES[slug]
    body = render_main(slug, Ctx(True))
    return f"<?php\n/** Послуга «{s['name']}». Згенеровано enray/tools/build_services.py — правте дані там. */\n?>\n" + body


def main():
    for slug in SERVICES:
        d = os.path.join(ROOT, 'posluhy', slug)
        os.makedirs(d, exist_ok=True)
        open(os.path.join(d, 'index.html'), 'w', encoding='utf-8').write(proto_page(slug))
        wd = os.path.join(ROOT, 'wp-theme', 'enray-2026', 'services')
        os.makedirs(wd, exist_ok=True)
        open(os.path.join(wd, slug + '.php'), 'w', encoding='utf-8').write(wp_partial(slug))
    print('ok:', ', '.join(SERVICES))


if __name__ == '__main__':
    main()
