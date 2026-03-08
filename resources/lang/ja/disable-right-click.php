<?php

return [
  'name' => '右クリック無効化',
  'description' => 'ウェブサイトの右クリック、テキスト選択、開発者コンソールを無効にしてコンテンツを保護します。',
  'settings' => [
    'title' => '右クリック無効化',
    'description' => '右クリック、テキスト選択、開発者コンソールの保護設定を構成します。',
    'enable_right_click' => '右クリックを無効にする',
    'enable_right_click_help' => 'ユーザーが右クリックメニューやキーボードショートカットを使用してソースコードを表示するのを防ぎます。',
    'enable_text_selection' => 'テキスト選択を無効にする',
    'enable_text_selection_help' => '著作権保護のため、ユーザーがウェブサイト上のテキストを選択してコピーするのを防ぎます。',
    'enable_copy_protection' => 'コピーを無効にする',
    'enable_copy_protection_help' => 'コンテンツを保護するため、コピーとカットの操作（Ctrl+C/Cmd+CおよびCtrl+X/Cmd+X）をブロックします。',
    'enable_image_drag_protection' => '画像ドラッグを無効にする',
    'enable_image_drag_protection_help' => 'ユーザーがウェブサイトから画像をドラッグして保存するのを防ぎます。',
    'enable_devtools_detection' => '開発者コンソールを無効にする',
    'enable_devtools_detection_help' => '開発者ツールが開かれたときにページを自動的にリロードします。デスクトップのみ — リロードループを防ぐためモバイルではスキップされます。',
    'saved' => '設定が正常に保存されました！',
  ],
];
