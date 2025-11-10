<?php

return [
    'name' => '右クリック無効化',
    'description' => 'Webサイトで右クリック、テキスト選択、および開発者コンソールを無効にしてコンテンツを保護します。',
    'settings' => [
        'title' => '右クリック無効化',
        'description' => '右クリック、テキスト選択、および開発者コンソールの保護設定を構成します。',
        'enable_right_click' => '右クリックを無効化',
        'enable_right_click_help' => 'ユーザーが右クリックコンテキストメニューとキーボードショートカットを使用してソースコードを表示するのを防ぎます。',
        'enable_text_selection' => 'テキスト選択を無効化',
        'enable_text_selection_help' => '著作権保護のため、ユーザーがWebサイト上でテキストを選択およびコピーするのを防ぎます。',
        'enable_devtools_detection' => '開発者コンソールを無効化',
        'enable_devtools_detection_help' => 'ブラウザで開発者ツール/コンソールが開かれたときに自動的にページをリロードします。',
        'saved' => '設定が正常に保存されました！',
    ],
];
