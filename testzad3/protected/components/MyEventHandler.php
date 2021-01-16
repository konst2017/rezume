<?php

class MyEventHandler

{

static function handleMissingTranslation($event) {

// CMissingTranslationEvent - класс этого события, // поэтому мы можем получить дополнительную

информацию о сообщении $text = implode("\n", array(

'Language: '.$event->language, Category:1.$event->category, 'Message:1.$event->message

// отправляем email

mai1('admin@example.com1, 'Отсутствует перевод', $text);
}
}
?>