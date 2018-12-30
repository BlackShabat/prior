(function () {

    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var PlainText = wp.editor.PlainText;

    /* Реєструємо блок, тобто додаємо його в модальне вікно з каталогом блоків
        Приймає 1-м параметро назву блоку. Використовує неймспейси через слеш В режимі code-editor ми будемо бачити коментарі типу <!-- wp:hello-world/block /--> шр огоратють всі блоки
        2-параметр вказуємо параметри блоку
    * */
    registerBlockType('hello-world/block', {
        title: 'Hello World Block',
        category: 'common',

        /* Обєкт де зберігаємо дані (стан блоку) кожна властивість якого репрезентує одну частину даних блоку
        Обєкт атибутів передається в save та edit методи в параметр callback ф-ї (в нашому випадку props)
        Властивості називаємо кастомно, але кожна з них повинна містити вбудовані властивості: source, selector, default (можливо ще якісь)
        * */
        attributes: {
            test: {
                source: 'children',
                selector: 'p',
                default: ''
            }
        },
        /* викликається коли ми змінюємо властивості блоку в адмінці
            викликається в адмінці багато раз
            Те що повертається - виводиться в тілі блоку в адмінці під час редагуавння. Якщо нічого не повернути, буде помилка при спробі додати блок на сторінку
            В основному треба повертати Реакт-елемент (wp.element.createElement() )
        * */
        edit: function (props) {
            return el(PlainText, {
                className: 'hello-world-editor',
                onChange: function (value) {
                    /* Ф-я збуджується кожного разу коли щось вводиться в поле вводу
                        value слід передати в контент save
                        Для збереження value (стану поля вводу) використовуються атрибути
                    * */
                    props.setAttributes({
                        test: value
                    })
                },
                /* Зберігаємо значеня інпута в адмінці коли збережене */
                value: props.attributes.test
            })
        },
        /* Викликається коли ми зберігаємо пост чи сторінку, під час автосейву дрофту
            Те що повертається додається в амдінці в область контенту що огорнути коментами неймспесу <!-- wp:hello-world/block -->що поверну save <!-- /wp:hello-world/block --> І це буде виведено на фронті. На фронті гутенберг буде шукати цей комент. В основному повертається Реакт-елемент (wp.element.createElement() ) і якщо на момент збереження контент що повертає save не буде співпадати з тим що повертає edit то буде помилка.
        * */
        save: function (props) {
            /* В якості контенту виводимо значення props.text що ми зберегли в onChange ф-ї edit() */
            return el('p', {className: 'hello-world'}, props.attributes.test)
        }
    });
})();

/*
    Коли ми в режимі Code Editor - http://prntscr.com/l4y4b8 ми переглядаємо те що виводиться на фронт. ТОбто те що повертає ф-я save, те що збережено
* */