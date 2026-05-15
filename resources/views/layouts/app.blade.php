<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mini Social - منصة التواصل الاجتماعي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        :root {
            --primary-glow: #4a6cfa;
            --secondary-glow: #8a2be2;
            --accent-glow: #00ffcc;
            --light-bg: #f8f9fa;
            --lighter-bg: #ffffff;
            --dark-bg: #0a0a1a;
            --darker-bg: #050510;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-dark: #212529;
            --text-muted: #6c757d;
            --text-light: #ffffff;
            --text-muted-dark: rgba(255, 255, 255, 0.7);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --like-color: #ff375f;
            --comment-color: #4a6cfa;
            --share-color: #00c9a7;
            --save-color: #ffc107;
            
            /* متغيرات للوضع الداكن */
            --dark-mode-bg: #0a0a1a;
            --dark-mode-text: #ffffff;
            --dark-mode-glass-bg: rgba(255, 255, 255, 0.1);
            --dark-mode-glass-border: rgba(255, 255, 255, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #e0e5ec 0%, #cfd6e4 100%);
            color: var(--text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
            transition: background 0.5s ease, color 0.5s ease;
        }

        /* تأثير الجسيمات في الخلفية */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* تصميم الزجاجي (Glassmorphism) محسن */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15), 
                        inset 0 0 0 1px rgba(255, 255, 255, 0.7);
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 25px;
        }

        .glass-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 45px rgba(74, 108, 250, 0.2), 
                        inset 0 0 0 1px rgba(255, 255, 255, 0.8);
        }

        /* تأثيرات النص */
        .glow-text {
            color: var(--primary-glow);
            font-weight: bold;
            text-shadow: 0 0 15px rgba(74, 108, 250, 0.4);
        }

        /* Avatar - تصميم زجاجي */
        .user-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--primary-glow), var(--secondary-glow));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.3rem;
            margin-left: 12px;
            transition: var(--transition);
            box-shadow: 0 8px 20px rgba(74, 108, 250, 0.3);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            backdrop-filter: blur(5px);
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right, rgba(255,255,255,0.4), rgba(255,255,255,0));
            transform: rotate(45deg);
        }

        .user-avatar:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 12px 30px rgba(74, 108, 250, 0.4);
        }

        /* تأثيرات الحركة */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes glow {
            0% { box-shadow: 0 0 10px rgba(74, 108, 250, 0.5), 
                             inset 0 0 0 1px rgba(255, 255, 255, 0.6); }
            50% { box-shadow: 0 0 25px rgba(74, 108, 250, 0.8), 
                             inset 0 0 0 1px rgba(255, 255, 255, 0.8); }
            100% { box-shadow: 0 0 10px rgba(74, 108, 250, 0.5), 
                             inset 0 0 0 1px rgba(255, 255, 255, 0.6); }
        }

        .glow-animation {
            animation: glow 4s ease-in-out infinite;
        }

        /* التكيف مع الشاشات المختلفة */
        @media (max-width: 768px) {
            .glass-card {
                border-radius: 16px;
                margin: 12px;
            }
            
            .user-avatar {
                width: 50px;
                height: 50px;
            }
        }

        /* تأثيرات التمرير */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* تصميم فيسبوك للمنشورات - بتصميم زجاجي */
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px 20px 0;
        }

        .post-info {
            flex-grow: 1;
        }

        .post-info h6 {
            margin: 0;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-dark);
        }

        .post-info h6:hover {
            text-decoration: underline;
        }

        .post-time {
            color: var(--text-muted);
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        .post-time i {
            margin-right: 5px;
        }

        .post-content {
            margin-bottom: 15px;
            padding: 0 20px;
        }

        .post-text {
            margin-bottom: 15px;
            line-height: 1.5;
            color: var(--text-dark);
            font-size: 15px;
        }

        .post-media {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .post-media img, .post-media video {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
        }

        .post-stats {
            display: flex;
            justify-content: space-between;
            padding: 12px 20px;
            border-bottom: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-size: 14px;
        }

        .reactions-count {
            display: flex;
            align-items: center;
        }

        .reactions-icons {
            display: flex;
            margin-left: 8px;
        }

        .reaction-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-size: cover;
            margin-right: -5px;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .post-actions {
            display: flex;
            justify-content: space-around;
            padding: 8px 5px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
            margin: 0 5px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
        }

        .action-btn:hover {
            background-color: rgba(74, 108, 250, 0.1);
            transform: translateY(-2px);
        }

        .action-btn i {
            margin-left: 6px;
            font-size: 16px;
        }

        /* نظام التفاعلات - مثل فيسبوك تمامًا */
        .fb-reaction-container {
            position: relative;
        }

        .fb-main-reaction {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .fb-main-reaction:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .fb-reactions-box {
            position: absolute;
            bottom: 100%;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 6px 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 100;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .fb-reaction-container:hover .fb-reactions-box {
            opacity: 1;
            visibility: visible;
        }

        .fb-reaction {
            width: 42px;
            height: 42px;
            margin: 0 3px;
            transition: transform 0.3s;
            cursor: pointer;
            font-size: 34px;
            line-height: 42px;
            text-align: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .fb-reaction:hover {
            transform: scale(1.4) translateY(-8px);
        }

        /* تخصيص ألوان الريأكتات */
        .like { color: #1877F2; }
        .love { color: #F3425F; }
        .care { color: #F7B928; }
        .haha { color: #F7B928; }
        .wow { color: #F7B928; }
        .sad { color: #F7B928; }
        .angry { color: #E4710A; }

        /* التعليقات - بتصميم زجاجي */
        .comments-section {
            margin-top: 15px;
            display: none;
            padding: 0 20px 15px;
        }

        .comment {
            display: flex;
            margin-bottom: 15px;
        }

        .comment-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--primary-glow), var(--secondary-glow));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-left: 12px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(74, 108, 250, 0.3);
        }

        .comment-content {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 18px;
            padding: 12px 15px;
            flex-grow: 1;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .comment-author {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
            color: var(--text-dark);
        }

        .comment-text {
            font-size: 14px;
            line-height: 1.4;
            color: var(--text-dark);
        }

        .comment-actions {
            display: flex;
            margin-top: 6px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .comment-action {
            margin-left: 15px;
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .comment-action:hover {
            color: var(--primary-glow);
        }

        .comment-action i {
            margin-left: 4px;
        }

        .comment-liked {
            color: var(--like-color);
            font-weight: bold;
        }

        .add-comment {
            display: flex;
            margin-top: 15px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            padding: 5px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
        }

        .comment-input {
            flex-grow: 1;
            background: transparent;
            border-radius: 20px;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            color: var(--text-dark);
        }

        .comment-input:focus {
            outline: none;
        }

        .comment-submit {
            background: linear-gradient(145deg, var(--primary-glow), var(--secondary-glow));
            border: none;
            color: white;
            font-weight: 600;
            cursor: pointer;
            margin-right: 5px;
            transition: var(--transition);
            border-radius: 20px;
            padding: 0 15px;
        }

        .comment-submit:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(74, 108, 250, 0.3);
        }

        /* إنشاء منشور جديد */
        .create-post-container {
            background: var(--glass-bg);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15), 
                        inset 0 0 0 1px rgba(255, 255, 255, 0.7);
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 25px;
            padding: 20px;
        }

        .post-input {
            width: 100%;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 15px;
            resize: none;
            min-height: 100px;
            font-family: inherit;
            font-size: 15px;
        }

        .post-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.9);
        }

        .media-preview {
            margin-bottom: 15px;
            border-radius: 12px;
            overflow: hidden;
            display: none;
        }

        .media-preview img, .media-preview video {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }

        .media-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .media-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .media-btn:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        .media-btn i {
            margin-left: 5px;
        }

        .post-submit {
            background: linear-gradient(145deg, var(--primary-glow), var(--secondary-glow));
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: block;
            margin-left: auto;
            box-shadow: 0 5px 15px rgba(74, 108, 250, 0.3);
        }

        .post-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 108, 250, 0.4);
        }

        /* القائمة الجانبية */
        .sidebar {
            background: rgba(10, 10, 26, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-left: 1px solid var(--glass-border);
            box-shadow: -5px 0 30px rgba(0, 0, 0, 0.4);
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100vh;
            z-index: 1050;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .sidebar .list-group-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 20px;
            transition: var(--transition);
        }

        .sidebar .list-group-item:hover {
            background: rgba(74, 108, 250, 0.1);
            padding-right: 25px;
        }

        .sidebar .list-group-item a {
            color: var(--text-light);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar .list-group-item a i {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        /* وضع الدارك مود */
        body.dark-mode {
            background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);
            color: var(--text-light);
        }

        body.dark-mode .glass-card,
        body.dark-mode .create-post-container {
            background: var(--dark-mode-glass-bg);
            border: 1px solid var(--dark-mode-glass-border);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.3), 
                        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        body.dark-mode .post-info h6,
        body.dark-mode .post-text,
        body.dark-mode .comment-author,
        body.dark-mode .comment-text {
            color: var(--text-light);
        }

        body.dark-mode .post-time,
        body.dark-mode .post-stats,
        body.dark-mode .comment-actions,
        body.dark-mode .action-btn {
            color: var(--text-muted-dark);
        }

        body.dark-mode .action-btn:hover {
            background-color: rgba(74, 108, 250, 0.2);
        }

        body.dark-mode .comment-content,
        body.dark-mode .add-comment,
        body.dark-mode .post-input,
        body.dark-mode .media-btn {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
        }

        body.dark-mode .comment-input {
            color: var(--text-light);
        }

        body.dark-mode .fb-reactions-box {
            background: rgba(30, 30, 50, 0.95);
            border-color: var(--dark-mode-glass-border);
        }

        body.dark-mode .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--dark-mode-glass-border);
            color: var(--text-light);
        }

        body.dark-mode .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary-glow);
            box-shadow: 0 0 15px rgba(74, 108, 250, 0.3);
            color: var(--text-light);
        }

        body.dark-mode .text-muted {
            color: var(--text-muted-dark) !important;
        }

        /* القائمة السفلية */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(248, 249, 250, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            display: flex;
            justify-content: space-around;
            padding: 12px 10px;
            box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-top: 1px solid var(--glass-border);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--text-muted);
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            padding: 8px 15px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.6);
            margin: 0 5px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-item.active {
            color: var(--primary-glow);
            background-color: rgba(74, 108, 250, 0.15);
            box-shadow: 0 5px 15px rgba(74, 108, 250, 0.2);
        }

        .nav-item:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .nav-item i {
            font-size: 22px;
            margin-bottom: 4px;
        }

        /* تعديلات للوضع الداكن على القائمة السفلية */
        body.dark-mode .bottom-nav,
        body.dark-mode .nav-item {
            background: rgba(10, 10, 26, 0.8);
            border-color: var(--dark-mode-glass-border);
        }

        body.dark-mode .nav-item {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-muted-dark);
        }

        body.dark-mode .nav-item.active {
            background-color: rgba(74, 108, 250, 0.2);
            color: var(--text-light);
        }

        /* الهيدر */
        .top-header {
            background: rgba(248, 249, 250, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 25px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: var(--primary-glow);
            font-weight: 800;
            font-size: 26px;
            text-shadow: 0 0 15px rgba(74, 108, 250, 0.4);
            letter-spacing: -0.5px;
        }

        .nav-icons {
            display: flex;
            gap: 18px;
        }

        .nav-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-icon:hover {
            background-color: rgba(74, 108, 250, 0.15);
            transform: scale(1.15) rotate(8deg);
            box-shadow: 0 8px 20px rgba(74, 108, 250, 0.2);
        }

        /* تعديلات للوضع الداكن على الهيدر */
        body.dark-mode .top-header {
            background: rgba(10, 10, 26, 0.8);
            border-color: var(--dark-mode-glass-border);
        }

        body.dark-mode .nav-icon {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: var(--dark-mode-glass-border);
        }

        /* تأثيرات */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* تحسينات إضافية */
        .container {
            max-width: 700px;
            margin: 90px auto 110px;
            padding: 20px;
        }
    </style>
</head>
<body>
<!-- جسيمات الخلفية -->
<div id="particles-js"></div>

<!-- الهيدر -->
<header class="top-header d-none d-md-flex">
    <div class="d-flex align-items-center">
        <button class="btn btn-link text-decoration-none me-3" onclick="toggleSidebar()" style="color: var(--text-dark);">
            <i class="bi bi-list h4 mb-0"></i>
        </button>
        <div class="logo">Mini Social</div>
    </div>
    <div class="nav-icons">
        <div class="nav-icon" onclick="toggleDarkMode()"><i class="bi bi-moon"></i></div>
        <div class="nav-icon"><i class="bi bi-search"></i></div>
        <div class="nav-icon"><i class="bi bi-chat"></i></div>
    </div>
</header>

<!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<div class="sidebar" id="sidebar">
    <ul class="list-group list-group-flush mt-4">
        <li class="list-group-item">
            <a href="/">
                <i class="bi bi-house-door"></i>Home
            </a>
        </li>
        <li class="list-group-item">
            <a href="/posts">
                <i class="bi bi-file-earmark-post"></i>Posts
            </a>
        </li>
        <li class="list-group-item">
            <a href="/profile">
                <i class="bi bi-person"></i>Profile
            </a>
        </li>
        <li class="list-group-item">
            <a href="/search">
                <i class="bi bi-search"></i>Search
            </a>
        </li>
        <li class="list-group-item">
            <a href="/notifications">
                <i class="bi bi-bell"></i>Notifications
            </a>
        </li>
        <li class="list-group-item">
            <a href="/settings">
                <i class="bi bi-gear"></i>Settings
            </a>
        </li>
        <li class="list-group-item">
            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i>Sign out
            </a>
        </li>
    </ul>
</div>

<main>
    @yield('content')
</main>

<!-- Bottom navigation -->
<nav class="bottom-nav d-md-none">
    <div class="nav-item active">
        <i class="bi bi-house-door-fill"></i>
        <span>Home</span>
    </div>
    <div class="nav-item">
        <i class="bi bi-people"></i>
        <span>Friends</span>
    </div>
    <div class="nav-item">
        <i class="bi bi-camera-video"></i>
        <span>Videos</span>
    </div>
    <div class="nav-item">
        <i class="bi bi-bell"></i>
        <span>Notifications</span>
    </div>
    <div class="nav-item" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
        <span>More</span>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // تهيئة جسيمات الخلفية بحجم أكبر وعدد أكثر
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS('particles-js', {
            particles: {
                number: { 
                    value: 120, 
                    density: { 
                        enable: true, 
                        value_area: 1000 
                    } 
                },
                color: { 
                    value: ["#4a6cfa", "#8a2be2", "#00c9a7"] 
                },
                shape: { 
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#000000"
                    }
                },
                opacity: { 
                    value: 0.5, 
                    random: true,
                    anim: {
                        enable: true,
                        speed: 1,
                        opacity_min: 0.3,
                        sync: false
                    }
                },
                size: { 
                    value: 6, 
                    random: true,
                    anim: {
                        enable: true,
                        speed: 3,
                        size_min: 0.3,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 180,
                    color: "#4a6cfa",
                    opacity: 0.3,
                    width: 2
                },
                move: {
                    enable: true,
                    speed: 3,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: true,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { 
                        enable: true, 
                        mode: "bubble" 
                    },
                    onclick: { 
                        enable: true, 
                        mode: "push" 
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 400,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    bubble: {
                        distance: 250,
                        size: 8,
                        duration: 2,
                        opacity: 0.8,
                        speed: 3
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 6
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });

        // Scroll animations
        const fadeElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(el => observer.observe(el));
        
        // Enable reaction buttons
        document.querySelectorAll('.fb-reaction').forEach(reaction => {
            reaction.addEventListener('click', function() {
                const reactionType = this.dataset.reaction;
                const mainReaction = this.closest('.fb-reaction-container').querySelector('.fb-main-reaction');
                
            // Update main reaction based on selection
                mainReaction.innerHTML = '';
                
                let icon, text;
                switch(reactionType) {
                 
                     case 'haha':
                        icon = '<span style="font-size: 16px;">👍</span>';
                        text = 'لايك';
                        break;
                    case 'wow':
                        icon = '<span style="font-size: 16px;">❤️</span>';
                        text = 'حب';
                        break;
                    case 'haha':
                        icon = '<span style="font-size: 16px;">😄</span>';
                        text = 'Haha';
                        break;
                    case 'wow':
                        icon = '<span style="font-size: 16px;">😯</span>';
                        text = 'Wow';
                        break;
                    case 'sad':
                        icon = '<span style="font-size: 16px;">😢</span>';
                        text = 'Sad';
                        break;
                    case 'angry':
                        icon = '<span style="font-size: 16px;">😡</span>';
                        text = 'Angry';
                        break;
                }
                
                mainReaction.innerHTML = `${icon} <span>${text}</span>`;
                
                // Hide reactions box after selection
                const reactionsBox = this.closest('.fb-reactions-box');
                reactionsBox.style.opacity = '0';
                reactionsBox.style.visibility = 'hidden';
                
                // Increment reactions count
                const statsElement = this.closest('.glass-card').querySelector('.reactions-count span');
                let currentCount = parseInt(statsElement.textContent);
                statsElement.textContent = currentCount + 1;
            });
        });
        
        // Submit comments
        document.querySelectorAll('.comment-submit').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const commentText = input.value.trim();
                
                if(commentText !== '') {
                    const commentsContainer = this.closest('.comments-section').querySelector('.comment:first-child') ? 
                        this.closest('.comments-section') : 
                        this.closest('.comments-section').querySelector('.add-comment');
                    
                    const newComment = document.createElement('div');
                    newComment.className = 'comment';
                    newComment.innerHTML = `
                        <div class="comment-avatar">Y</div>
                        <div class="comment-content">
                            <div class="comment-author">You</div>
                            <div class="comment-text">${commentText}</div>
                            <div class="comment-actions">
                                <span class="comment-action" onclick="likeComment(this)">
                                    <i class="bi bi-hand-thumbs-up"></i> Like
                                </span>
                                <span class="comment-action">Reply</span>
                                <span class="comment-action">Now</span>
                                <span class="comment-action">0</span>
                            </div>
                        </div>
                    `;
                    
                    commentsContainer.parentNode.insertBefore(newComment, commentsContainer);
                    input.value = '';
                    
                    // Increment comments count
                    const commentsCount = this.closest('.glass-card').querySelector('.comments-count');
                    let currentCount = parseInt(commentsCount.textContent);
                    commentsCount.textContent = (currentCount + 1) + ' comments';
                }
            });
        });
        
        // Submit comment with Enter
        document.querySelectorAll('.comment-input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    this.nextElementSibling.click();
                }
            });
        });
        
        // Upload images/videos for new posts
        const imageUpload = document.getElementById('imageUpload');
        const videoUpload = document.getElementById('videoUpload');
        const mediaPreview = document.getElementById('mediaPreview');
        
        imageUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    mediaPreview.innerHTML = `<img src="${e.target.result}" alt="Post image">`;
                    mediaPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        videoUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    mediaPreview.innerHTML = `<video controls><source src="${e.target.result}" type="${file.type}">Your browser does not support video playback</video>`;
                    mediaPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Publish a new post
        const postSubmit = document.querySelector('.post-submit');
        const postInput = document.querySelector('.post-input');
        
        postSubmit.addEventListener('click', function() {
            const postText = postInput.value.trim();
            const mediaContent = mediaPreview.innerHTML;
            
            if(postText !== '' || mediaContent !== '') {
                createNewPost(postText, mediaContent);
                postInput.value = '';
                mediaPreview.innerHTML = '';
                mediaPreview.style.display = 'none';
                imageUpload.value = '';
                videoUpload.value = '';
            }
        });

        // Load user preferences
        const darkMode = localStorage.getItem('darkMode');
        if(darkMode === 'enabled'){
            document.body.classList.add('dark-mode');
        }
    });
    
    // Toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }
    
    // Toggle dark mode
    function toggleDarkMode() {
        const body = document.body;
        body.classList.toggle('dark-mode');
        // حفظ التفضيل في localStorage
        if(body.classList.contains('dark-mode')){
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }
    }
    
    // Show/Hide comments
    function toggleComments(btn) {
        const commentsSection = btn.closest('.post-actions').nextElementSibling;
        if(commentsSection.style.display === 'block') {
            commentsSection.style.display = 'none';
        } else {
            commentsSection.style.display = 'block';
        }
    }
    
    // Like comments
    function likeComment(btn) {
        const likeCount = btn.nextElementSibling.nextElementSibling.nextElementSibling;
        let count = parseInt(likeCount.textContent);
        
        if(btn.classList.contains('comment-liked')) {
            btn.classList.remove('comment-liked');
            btn.innerHTML = '<i class="bi bi-hand-thumbs-up"></i> Like';
            likeCount.textContent = count - 1;
        } else {
            btn.classList.add('comment-liked');
            btn.innerHTML = '<i class="bi bi-hand-thumbs-up-fill"></i> Liked';
            likeCount.textContent = count + 1;
        }
    }
    
    // Create a new post
    function createNewPost(text, media) {
        const postsContainer = document.querySelector('.container');
        const postElement = document.createElement('div');
        postElement.className = 'glass-card fade-in';
        
        let mediaHtml = '';
        if (media) {
            mediaHtml = `<div class="post-media">${media}</div>`;
        }
        
        postElement.innerHTML = `
            <div class="post-header">
                <div class="user-avatar glow-animation">M</div>
                <div class="post-info">
                    <h6>Mohamed Ahmed</h6>
                    <div class="post-time">
                        <i class="bi bi-globe"></i> Now
                    </div>
                </div>
                <i class="bi bi-three-dots" style="color: var(--text-muted); cursor: pointer;"></i>
            </div>
            
            <div class="post-content">
                <p class="post-text">${text}</p>
                ${mediaHtml}
            </div>
            
            <div class="post-stats">
                <div class="reactions-count">
                    <div class="reactions-icons">
                        <div class="reaction-icon" style="background-color: #1877F2;"></div>
                    </div>
                    <span>1</span>
                </div>
                <div class="comments-count">0 comments</div>
            </div>
            
            <div class="post-actions">
                <div class="fb-reaction-container">
                    <div class="fb-main-reaction">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <div class="fb-reactions-box">
                        <div class="fb-reaction like" title="Like" data-reaction="like">👍</div>
                        <div class="fb-reaction love" title="Love" data-reaction="love">❤️</div>
                        <div class="fb-reaction haha" title="Haha" data-reaction="haha">😄</div>
                        <div class="fb-reaction wow" title="Wow" data-reaction="wow">😯</div>
                        <div class="fb-reaction sad" title="Sad" data-reaction="sad">😢</div>
                        <div class="fb-reaction angry" title="Angry" data-reaction="angry">😡</div>
                    </div>
                </div>
                
                <div class="action-btn" onclick="toggleComments(this)">
                    <i class="bi bi-chat"></i>
                    <span>Comment</span>
                </div>
                
                <div class="action-btn">
                    <i class="bi bi-share"></i>
                    <span>Share</span>
                </div>
            </div>
            
            <div class="comments-section">
                <div class="add-comment">
                    <input type="text" class="comment-input" placeholder="Write a comment...">
                    <button class="comment-submit">Post</button>
                </div>
            </div>
        `;
        
        // إدراج المنشور الجديد بعد قسم إنشاء المنشور
        const createPostContainer = document.querySelector('.create-post-container');
        postsContainer.insertBefore(postElement, createPostContainer.nextSibling);
        
        // إضافة مستمعي الأحداث للعناصر الجديدة
        setTimeout(() => {
            const newReactions = postElement.querySelectorAll('.fb-reaction');
            newReactions.forEach(reaction => {
                reaction.addEventListener('click', function() {
                    const reactionType = this.dataset.reaction;
                    const mainReaction = this.closest('.fb-reaction-container').querySelector('.fb-main-reaction');
                    
                    mainReaction.innerHTML = '';
                    
                    let icon, text;
                    switch(reactionType) {
                        case 'like':
                            icon = '<i class="bi bi-hand-thumbs-up-fill" style="color: #1877F2;"></i>';
                            text = 'Like';
                            break;
                        case 'love':
                            icon = '<i class="bi bi-heart-fill" style="color: #F3425F;"></i>';
                            text = 'Love';
                            break;
                        case 'haha':
                            icon = '<span style="font-size: 16px;">😄</span>';
                            text = 'Haha';
                            break;
                        case 'wow':
                            icon = '<span style="font-size: 16px;">😯</span>';
                            text = 'Wow';
                            break;
                        case 'sad':
                            icon = '<span style="font-size: 16px;">😢</span>';
                            text = 'Sad';
                            break;
                        case 'angry':
                            icon = '<span style="font-size: 16px;">😡</span>';
                            text = 'Angry';
                            break;
                    }
                    
                    mainReaction.innerHTML = `${icon} <span>${text}</span>`;
                    
                    const reactionsBox = this.closest('.fb-reactions-box');
                    reactionsBox.style.opacity = '0';
                    reactionsBox.style.visibility = 'hidden';
                    
                    const statsElement = this.closest('.glass-card').querySelector('.reactions-count span');
                    let currentCount = parseInt(statsElement.textContent);
                    statsElement.textContent = currentCount + 1;
                });
            });
            
            const newCommentBtn = postElement.querySelector('.comment-submit');
            newCommentBtn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const commentText = input.value.trim();
                
                if(commentText !== '') {
                    const commentsContainer = this.closest('.comments-section').querySelector('.comment:first-child') ? 
                        this.closest('.comments-section') : 
                        this.closest('.comments-section').querySelector('.add-comment');
                    
                    const newComment = document.createElement('div');
                    newComment.className = 'comment';
                    newComment.innerHTML = `
                        <div class="comment-avatar">Y</div>
                        <div class="comment-content">
                            <div class="comment-author">You</div>
                            <div class="comment-text">${commentText}</div>
                            <div class="comment-actions">
                                <span class="comment-action" onclick="likeComment(this)">
                                    <i class="bi bi-hand-thumbs-up"></i> Like
                                </span>
                                <span class="comment-action">Reply</span>
                                <span class="comment-action">Now</span>
                                <span class="comment-action">0</span>
                            </div>
                        </div>
                    `;
                    
                    commentsContainer.parentNode.insertBefore(newComment, commentsContainer);
                    input.value = '';
                    
                    const commentsCount = this.closest('.glass-card').querySelector('.comments-count');
                    let currentCount = parseInt(commentsCount.textContent);
                    commentsCount.textContent = (currentCount + 1) + ' comments';
                }
            });
            
            const newCommentInput = postElement.querySelector('.comment-input');
            newCommentInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    this.nextElementSibling.click();
                }
            });
        }, 100);
    }
</script>
</body>
</html>