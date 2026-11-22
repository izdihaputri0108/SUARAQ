<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUARAQ - Your Space, Your Voice</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --pink: #e99ab5;
            --pink-dark: #d8799d;
            --pink-light: #fce8ef;
            --pink-pale: #fff7fa;
            --text: #493640;
            --muted: #9b8790;
            --white: #ffffff;
            --border: #f3e5eb;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--pink-pale);
            color: var(--text);
        }

        button, input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .layout {
            display: grid;
            grid-template-columns: 245px minmax(0, 1fr) 280px;
            max-width: 1440px;
            min-height: 100vh;
            margin: auto;
        }

        /* SIDEBAR */
        .sidebar {
            background: white;
            border-right: 1px solid var(--border);
            padding: 35px 23px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 29px;
            font-weight: 800;
            color: var(--pink-dark);
            letter-spacing: -1.5px;
        }

        .tagline {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        .menu-title {
            font-size: 11px;
            color: #b9a7af;
            font-weight: 700;
            margin: 45px 0 15px 10px;
            letter-spacing: 1.5px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .menu a {
            text-decoration: none;
            color: #927e87;
            padding: 13px 14px;
            border-radius: 13px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--pink-light);
            color: var(--pink-dark);
        }

        .menu-icon {
            font-size: 18px;
            width: 23px;
            text-align: center;
        }

        .sidebar-bottom {
            position: absolute;
            bottom: 30px;
            left: 23px;
            right: 23px;
        }

        .profile-mini {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 13px 8px;
            border-top: 1px solid var(--border);
        }

        .avatar {
            width: 39px;
            height: 39px;
            border-radius: 50%;
            background: #f8d5e2;
            display: grid;
            place-items: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .profile-mini strong {
            font-size: 12px;
            display: block;
        }

        .profile-mini small {
            color: var(--muted);
            font-size: 10px;
        }

        /* MAIN CONTENT */
        .main {
            padding: 32px 38px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 32px;
        }

        .greeting h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 21px;
        }

        .greeting p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        .search {
            background: white;
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 11px 16px;
            width: 220px;
            outline: none;
            font-size: 12px;
        }

        .search:focus {
            border-color: var(--pink);
        }

        /* HERO */
        .hero {
            background: linear-gradient(120deg, #f8dce6, #fcebf1);
            border-radius: 22px;
            padding: 29px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .hero h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 25px;
            line-height: 1.4;
            max-width: 360px;
            margin-bottom: 9px;
        }

        .hero p {
            color: #876b78;
            font-size: 13px;
            line-height: 1.7;
            max-width: 350px;
        }

        .hero-decoration {
            position: absolute;
            right: 28px;
            top: 18px;
            font-size: 76px;
            opacity: .65;
        }

        .hero-button {
            display: inline-block;
            margin-top: 19px;
            background: var(--pink-dark);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 11px 19px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .hero-button:hover {
            background: #c9678e;
        }

        /* FEED */
        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 17px;
        }

        .section-heading h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 17px;
        }

        .section-heading span {
            color: var(--pink-dark);
            font-size: 11px;
            font-weight: 700;
        }

        .tabs {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 19px;
        }

        .tab {
            border: none;
            background: none;
            padding: 0 2px 12px;
            color: var(--muted);
            font-size: 12px;
        }

        .tab.active {
            color: var(--pink-dark);
            font-weight: 700;
            border-bottom: 2px solid var(--pink-dark);
        }

        .post {
            background: white;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 21px;
            margin-bottom: 16px;
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .post-avatar {
            width: 37px;
            height: 37px;
            border-radius: 50%;
            background: #fce8ef;
            display: grid;
            place-items: center;
            font-size: 17px;
        }

        .post-author strong {
            font-size: 12px;
            display: block;
        }

        .post-author small {
            font-size: 10px;
            color: var(--muted);
        }

        .anonymous {
            margin-left: auto;
            background: var(--pink-light);
            color: var(--pink-dark);
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
        }

        .post-content {
            font-size: 13px;
            line-height: 1.8;
            color: #66515b;
        }

        .post-footer {
            display: flex;
            gap: 20px;
            margin-top: 18px;
            padding-top: 13px;
            border-top: 1px solid #f8eff3;
        }

        .post-footer button {
            border: none;
            background: none;
            color: #a18c96;
            font-size: 11px;
        }

        .post-footer button:hover {
            color: var(--pink-dark);
        }

        /* RIGHT PANEL */
        .right-panel {
            background: white;
            border-left: 1px solid var(--border);
            padding: 35px 20px;
        }

        .right-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            margin-bottom: 17px;
        }

        .trend-card {
            background: var(--pink-pale);
            border: 1px solid var(--border);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 11px;
        }

        .trend-card small {
            color: var(--pink-dark);
            font-size: 10px;
            font-weight: 700;
        }

        .trend-card strong {
            display: block;
            font-size: 12px;
            margin: 6px 0;
        }

        .trend-card p {
            font-size: 10px;
            color: var(--muted);
        }

        .community {
            margin-top: 32px;
        }

        .community-box {
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .community-icon {
            width: 36px;
            height: 36px;
            background: var(--pink-light);
            border-radius: 11px;
            display: grid;
            place-items: center;
        }

        .community-box strong {
            font-size: 11px;
            display: block;
        }

        .community-box small {
            font-size: 9px;
            color: var(--muted);
        }

        .footer-note {
            color: #b9a7af;
            font-size: 10px;
            line-height: 1.8;
            margin-top: 35px;
        }

        @media (max-width: 1050px) {
            .layout {
                grid-template-columns: 210px minmax(0, 1fr);
            }

            .right-panel {
                display: none;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: static;
                height: auto;
                padding: 18px 20px;
                border-bottom: 1px solid var(--border);
            }

            .menu-title,
            .sidebar-bottom {
                display: none;
            }

            .menu {
                flex-direction: row;
                overflow-x: auto;
                margin-top: 15px;
            }

            .menu a {
                white-space: nowrap;
                padding: 9px;
                font-size: 11px;
            }

            .main {
                padding: 23px 17px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .search {
                width: 100%;
            }

            .hero {
                padding: 23px;
            }

            .hero h1 {
                font-size: 21px;
                max-width: 230px;
            }

            .hero-decoration {
                right: 12px;
                font-size: 48px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">SUARAQ.</div>
        <p class="tagline">YOUR SPACE, YOUR VOICE ♡</p>

        <p class="menu-title">MENU UTAMA</p>

        <nav class="menu">
            <a href="#" class="active"><span class="menu-icon">⌂</span> Home</a>
            <a href="#"><span class="menu-icon">⌕</span> Explore</a>
            <a href="#"><span class="menu-icon">♡</span> My Menfess</a>
            <a href="#"><span class="menu-icon">✉</span> Notifications</a>
            <a href="#"><span class="menu-icon">♙</span> My Profile</a>
        </nav>

        <div class="sidebar-bottom">
            <div class="profile-mini">
                <div class="avatar">🌷</div>
                <div>
                    <strong>Guest User</strong>
                    <small>Welcome to SUARAQ</small>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <header class="topbar">
            <div class="greeting">
                <h2>Hi, welcome to SUARAQ! ♡</h2>
                <p>A little space for every voice to be heard.</p>
            </div>

            <input
                type="text"
                class="search"
                placeholder="⌕  Search menfess..."
            >
        </header>

        <!-- HERO -->
        <section class="hero">
            <div class="hero-decoration">💌</div>

            <h1>Your thoughts deserve a place to be heard.</h1>

            <p>
                Share your stories, thoughts, and little secrets.
                Be yourself, speak freely, and connect with others.
            </p>

            <!-- CREATE MENFESS -->
            <a href="{{ route('menfesses.create') }}" class="hero-button">
                + Create Menfess
            </a>
        </section>

        <!-- FEED -->
        <section>
            <div class="section-heading">
                <h3>Community Feed</h3>
                <span>See what's new ♡</span>
            </div>

            <div class="tabs">
                <button class="tab active">For You</button>
                <button class="tab">Latest</button>
                <button class="tab">Popular</button>
            </div>

            <!-- POST 1 -->
            <article class="post">
                <div class="post-header">
                    <div class="post-avatar">🌸</div>

                    <div class="post-author">
                        <strong>Anonymous</strong>
                        <small>2 hours ago · Student Community</small>
                    </div>

                    <span class="anonymous">ANONYMOUS</span>
                </div>

                <p class="post-content">
                    Kadang capek juga ya jadi mahasiswa.
                    Tugas banyak, kegiatan banyak, tapi tetap harus
                    kelihatan baik-baik aja. Semangat buat kita semua
                    yang sedang berjuang. You are doing great! ♡
                </p>

                <div class="post-footer">
                    <button onclick="alert('Fitur like akan segera hadir!')">♡ 24 Likes</button>
                    <button onclick="alert('Fitur komentar akan segera hadir!')">☏ 8 Comments</button>
                    <button>↗ Share</button>
                </div>
            </article>

            <!-- POST 2 -->
            <article class="post">
                <div class="post-header">
                    <div class="post-avatar">🧸</div>

                    <div class="post-author">
                        <strong>Anonymous</strong>
                        <small>5 hours ago · Student Community</small>
                    </div>

                    <span class="anonymous">ANONYMOUS</span>
                </div>

                <p class="post-content">
                    Ada yang suka belajar di cafe sendirian?
                    Lagi nyari rekomendasi tempat yang nyaman buat
                    nugas sambil minum kopi. Drop rekomendasinya dong!
                </p>

                <div class="post-footer">
                    <button onclick="alert('Fitur like akan segera hadir!')">♡ 16 Likes</button>
                    <button onclick="alert('Fitur komentar akan segera hadir!')">☏ 12 Comments</button>
                    <button>↗ Share</button>
                </div>
            </article>

            <!-- POST 3 -->
            <article class="post">
                <div class="post-header">
                    <div class="post-avatar">🌷</div>

                    <div class="post-author">
                        <strong>Anonymous</strong>
                        <small>Yesterday · Student Community</small>
                    </div>

                    <span class="anonymous">ANONYMOUS</span>
                </div>

                <p class="post-content">
                    Reminder kecil untuk kamu: nggak harus selalu
                    produktif setiap hari. Istirahat juga bagian
                    dari proses. Jangan terlalu keras sama diri sendiri.
                </p>

                <div class="post-footer">
                    <button onclick="alert('Fitur like akan segera hadir!')">♡ 38 Likes</button>
                    <button onclick="alert('Fitur komentar akan segera hadir!')">☏ 5 Comments</button>
                    <button>↗ Share</button>
                </div>
            </article>
        </section>
    </main>

    <!-- RIGHT PANEL -->
    <aside class="right-panel">

        <section>
            <h3 class="right-title">Trending Topics ✨</h3>

            <div class="trend-card">
                <small>#01 · TRENDING</small>
                <strong>Campus Life</strong>
                <p>Stories and moments from campus.</p>
            </div>

            <div class="trend-card">
                <small>#02 · POPULAR</small>
                <strong>Love & Friendship</strong>
                <p>Share your little stories.</p>
            </div>

            <div class="trend-card">
                <small>#03 · COMMUNITY</small>
                <strong>Academic Talks</strong>
                <p>Discuss study and college life.</p>
            </div>
        </section>

        <section class="community">
            <h3 class="right-title">Our Community ♡</h3>

            <div class="community-box">
                <div class="community-icon">🎓</div>
                <div>
                    <strong>Campus Stories</strong>
                    <small>Student experiences</small>
                </div>
            </div>

            <div class="community-box">
                <div class="community-icon">☕</div>
                <div>
                    <strong>Daily Talks</strong>
                    <small>Everyday conversations</small>
                </div>
            </div>

            <div class="community-box">
                <div class="community-icon">💗</div>
                <div>
                    <strong>Heart to Heart</strong>
                    <small>Thoughts and feelings</small>
                </div>
            </div>
        </section>

        <p class="footer-note">
            SUARAQ © 2026<br>
            Your space, your voice.<br>
            Made with love ♡
        </p>
    </aside>

</div>
</body>
</html>
