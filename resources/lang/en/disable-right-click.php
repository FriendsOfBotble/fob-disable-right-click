<?php

return [
    'name' => 'Disable Right Click',
    'description' => 'Disable right-click, text selection, and developer console on your website to protect your content.',
    'settings' => [
        'title' => 'Disable Right Click',
        'description' => 'Configure right-click, text selection, and developer console protection settings.',
        'enable_right_click' => 'Disable Right Click',
        'enable_right_click_help' => 'Prevent users from using right-click context menu and keyboard shortcuts to view source code.',
        'enable_text_selection' => 'Disable Text Selection',
        'enable_text_selection_help' => 'Prevent users from selecting and copying text on your website for copyright protection.',
        'enable_copy_protection' => 'Disable Copy',
        'enable_copy_protection_help' => 'Block copy and cut actions (Ctrl+C/Cmd+C and Ctrl+X/Cmd+X) to protect your content.',
        'enable_image_drag_protection' => 'Disable Image Dragging',
        'enable_image_drag_protection_help' => 'Prevent users from dragging and saving images from your website.',
        'enable_devtools_detection' => 'Disable Developer Console',
        'enable_devtools_detection_help' => 'Automatically reload the page when developer tools is opened. Desktop only — skipped on mobile to prevent reload loops.',
        'saved' => 'Settings saved successfully!',
    ],
];
