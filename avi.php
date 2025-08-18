<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us · Your Brand</title>
  <meta name="description" content="Contact page with a modern, accessible design. Built with only HTML & CSS." />
  <style>
    :root {
      --bg: #0b1020;
      --card: rgba(255, 255, 255, .08);
      --card-strong: rgba(255, 255, 255, .12);
      --text: #e6e9f0;
      --muted: #b7bfd6;
      --accent: #7aa2ff;
      --accent-2: #8be3ff;
      --ring: #a5b4fc;
      --shadow: 0 10px 30px rgba(0, 0, 0, .35), inset 0 1px 0 rgba(255, 255, 255, .05);
      --radius: 18px;
      --radius-lg: 24px;
      --gap: 22px;
      --transition: 180ms ease;
    }

    @media (prefers-color-scheme: light) {
      :root {
        --bg: #edf2f7;
        --card: rgba(255, 255, 255, .7);
        --card-strong: rgba(255, 255, 255, .85);
        --text: #0d1b2a;
        --muted: #42536b;
        --accent: #4f7cff;
        --accent-2: #00bcd4;
        --ring: #4f46e5;
      }
    }

    * {
      box-sizing: border-box
    }

    html,
    body {
      height: 100%
    }

    body {
      margin: 0;
      font: 16px/1.5 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color: var(--text);
      /* background:
        radial-gradient(1200px 800px at 10% 10%, rgba(122,162,255,.18), transparent 50%),
        radial-gradient(1000px 600px at 90% 30%, rgba(139,227,255,.22), transparent 50%),
        linear-gradient(180deg, #0b1020, #0b1020), var(--bg);
      background-attachment: fixed, fixed, fixed, fixed; */
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      background-attachment: fixed;
      min-height: 100vh;
    }

    .container {
      max-width: 1150px;
      margin: min(8vh, 80px) auto;
      padding: 0 20px;
    }

    .wrap {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: var(--gap);
      align-items: stretch;
    }

    .card {
      background: var(--card);
      backdrop-filter: blur(16px) saturate(120%);
      -webkit-backdrop-filter: blur(16px) saturate(120%);
      box-shadow: var(--shadow);
      border: 1px solid rgba(255, 255, 255, .12);
      border-radius: var(--radius-lg);
    }

    header.hero {
      margin-bottom: 22px;
      text-align: center;
    }

    .kicker {
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--muted);
      font-size: .8rem
    }

    h1 {
      margin: .35rem 0 0;
      font-size: clamp(1.6rem, 2.4vw + 1rem, 2.5rem)
    }

    .subtitle {
      color: var(--muted);
      max-width: 65ch;
      margin: .5rem auto 0
    }

    /* Left info panel */
    .info {
      padding: 28px
    }

    .info .block {
      background: var(--card-strong);
      border-radius: var(--radius);
      padding: 18px 18px;
      border: 1px solid rgba(255, 255, 255, .12)
    }

    .info .block+.block {
      margin-top: 14px
    }

    .row {
      display: flex;
      align-items: flex-start;
      gap: 14px
    }

    .icon {
      flex: 0 0 44px;
      height: 44px;
      border-radius: 12px;
      display: grid;
      place-items: center;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      color: #020617
    }

    .row .text {
      flex: 1
    }

    .row .text h3 {
      margin: 0 0 4px;
      font-size: 1.05rem
    }

    .row .text p {
      margin: 0;
      color: var(--muted)
    }

    .muted {
      color: var(--muted)
    }

    .socials {
      display: flex;
      gap: 10px;
      margin-top: 10px
    }

    .chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: 999px;
      background: var(--card);
      border: 1px solid rgba(255, 255, 255, .12);
      text-decoration: none;
      color: var(--text);
      font-weight: 500;
      transition: transform var(--transition), background var(--transition), border-color var(--transition);
    }

    .chip:focus-visible {
      outline: none;
      box-shadow: 0 0 0 3px var(--ring)
    }

    .chip:hover {
      transform: translateY(-2px);
      background: var(--card-strong);
      border-color: rgba(255, 255, 255, .22)
    }

    /* Form */
    .form {
      padding: 28px
    }

    form {
      display: grid;
      gap: 14px
    }

    .field {
      display: grid;
      gap: 8px
    }

    label {
      font-weight: 600
    }

    input,
    textarea,
    select {
      width: 100%;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, .18);
      background: rgba(255, 255, 255, .08);
      color: var(--text);
      padding: 12px 14px;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, .06);
      transition: border-color var(--transition), box-shadow var(--transition), background var(--transition);
    }

    textarea {
      min-height: 140px;
      resize: vertical
    }

    input::placeholder,
    textarea::placeholder {
      color: #9aa4bf
    }

    input:focus-visible,
    textarea:focus-visible,
    select:focus-visible {
      outline: none;
      border-color: var(--accent-2);
      box-shadow: 0 0 0 3px rgba(139, 227, 255, .25)
    }

    .inline {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px
    }

    .hint {
      font-size: .9rem;
      color: var(--muted)
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 6px
    }

    .btn {
      border: none;
      cursor: pointer;
      font-weight: 700;
      letter-spacing: .3px;
      padding: 12px 18px;
      border-radius: 14px;
      transition: transform var(--transition), filter var(--transition), box-shadow var(--transition);
      color: #020617;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      box-shadow: 0 12px 24px rgba(0, 0, 0, .25);
    }

    .btn:hover {
      transform: translateY(-1.5px)
    }

    .btn:active {
      transform: translateY(0);
      filter: saturate(90%)
    }

    .btn.outline {
      background: transparent;
      color: var(--text);
      border: 1px solid rgba(255, 255, 255, .18)
    }

    /* Map */
    .map {
      overflow: hidden;
      border-radius: var(--radius);
      border: 1px solid rgba(255, 255, 255, .12);
      height: 260px
    }

    .map iframe {
      width: 100%;
      height: 100%;
      border: 0
    }

    /* Footer note */
    .foot {
      margin-top: 14px;
      font-size: .9rem;
      color: var(--muted);
      text-align: center
    }

    /* Responsive */
    @media (max-width: 900px) {
      .wrap {
        grid-template-columns: 1fr
      }

      .inline {
        grid-template-columns: 1fr
      }

      .map {
        height: 220px
      }
    }

    /* Form improvements */
    .contact-form {
      flex: 1;
      padding: 30px;
    }

    .contact-form h2 {
      color: #b30000;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      outline: none;
      background: rgba(255, 255, 255, 0.85);
      font-size: 15px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }

    .form-group textarea {
      resize: none;
      height: 100px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      box-shadow: 0 4px 12px rgba(179, 0, 0, 0.25);
      background: white;
    }

    .form-group label {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      font-size: 14px;
      color: #666;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    /* Floating label effect */
    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:focus+label,
    .form-group textarea:not(:placeholder-shown)+label {
      top: -8px;
      left: 8px;
      font-size: 12px;
      background: rgba(255, 255, 255, 0.85);
      padding: 0 4px;
      border-radius: 4px;
      color: #b30000;
    }

    .contact-form button {
      background: linear-gradient(135deg, #b30000, #ff4d4d);
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: transform 0.2s ease, background 0.3s ease;
      box-shadow: 0 4px 10px rgba(179, 0, 0, 0.3);
    }

    .contact-form button:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #a00000, #e64545);
    }
  </style>
</head>

<body>
  <div class="container">
    <header class="hero">
      <div class="kicker">Get in touch</div>
      <h1>We're here to help</h1>
      <p class="subtitle">Questions, collaborations, or feedback — drop us a line and we’ll get back to you as soon as possible.</p>
    </header>

    <div class="wrap">
      <!-- Info panel -->
      <section class="info card">
        <div class="block">
          <div class="row">
            <div class="icon" aria-hidden="true">
              <!-- Phone icon -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V21a1 1 0 01-1 1C10.85 22 2 13.15 2 2a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.24 1.02l-2.2 2.2z" />
              </svg>
            </div>
            <div class="text">
              <h3>Call us</h3>
              <p>
                <a class="chip" href="tel:+919836346059" aria-label="Call +91 9836346059">+91 9836346059</a>
              </p>
              <p class="muted">Mon–Fri, 9:00–18:00 IST</p>
            </div>
          </div>
        </div>

        <div class="block">
          <div class="row">
            <div class="icon" aria-hidden="true">
              <!-- Mail icon -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5L4 8V6l8 5 8-5v2z" />
              </svg>
            </div>
            <div class="text">
              <h3>Email</h3>
              <p>
                <a class="chip" href="mailto:hellodarling1253@gamil.com">hellodarling1253@gmail.com</a>
              </p>
              <p class="muted">We usually respond within 1 business day</p>
            </div>
          </div>
        </div>

        <div class="block">
          <div class="row">
            <div class="icon" aria-hidden="true">
              <!-- Pin icon -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 119.5 9 2.5 2.5 0 0112 11.5z" />
              </svg>
            </div>
            <div class="text">
              <h3>Office</h3>
              <p>221B, Park Street, Kolkata 700016</p>
              <div class="map" aria-label="Map to our office">
                <!-- Replace the src below with your location embed from Google Maps -->
                <iframe loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.712329089363!2d88.3639!3d22.5534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277a7a8e2b7e9%3A0x0000000000000000!2sPark%20Street%2C%20Kolkata!5e0!3m2!1sen!2sin!4v1680000000000"></iframe>
              </div>
            </div>
          </div>
        </div>

        <div class="block">
          <div class="row">
            <div class="icon" aria-hidden="true">
              <!-- Share icon -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 16a3 3 0 00-2.24 1.02l-7.1-3.55a3.06 3.06 0 000-2.94l7.1-3.55A3 3 0 1014 5a2.93 2.93 0 00.07.64l-7.1 3.55a3 3 0 100 5.62l7.1 3.55A2.93 2.93 0 0014 19a3 3 0 103-3z" />
              </svg>
            </div>
            <div class="text">
              <h3>Social</h3>
              <div class="socials">
                <a class="chip" href="#" aria-label="Visit us on Twitter">Twitter</a>
                <a class="chip" href="#" aria-label="Visit us on Instagram">Instagram</a>
                <a class="chip" href="#" aria-label="Visit us on LinkedIn">LinkedIn</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Form panel -->
      <section class="form card" aria-label="Contact form">
        <form action="#" method="post">
          <div class="inline">
            <div class="field">
              <label for="fname">First name</label>
              <input id="fname" name="first_name" type="text" placeholder="e.g., Arnab" autocomplete="given-name" required />
            </div>
            <div class="field">
              <label for="lname">Last name</label>
              <input id="lname" name="last_name" type="text" placeholder="e.g., Bag" autocomplete="family-name" required />
            </div>
          </div>

          <div class="inline">
            <div class="field">
              <label for="email">Email</label>
              <input id="email" name="email" type="email" placeholder="@gmail.com" autocomplete="email" required />
            </div>
            <div class="field">
              <label for="phone">Phone (optional)</label>
              <input id="phone" name="phone" type="tel" placeholder="+91 9876" autocomplete="tel" />
            </div>
          </div>

          <div class="field">
            <label for="topic">Topic</label>
            <select id="topic" name="topic" required>
              <option value="" disabled selected>Select a topic</option>
              <option>General inquiry</option>
              <option>Support</option>
              <option>Feedback</option>
              <option>Partnership</option>
            </select>
          </div>

          <div class="field">
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Tell us a bit about what you need…" required></textarea>
            <div class="hint">By submitting, you agree to our <a href="#" style="color:var(--accent-2); text-underline-offset:3px">terms</a>.</div>
          </div>

          <div class="actions">
            <button class="btn" type="submit">Send message</button>
            <button class="btn outline" type="reset">Reset</button>
          </div>
        </form>
        <p class="foot">Prefer email? Write to <a href="mailto:hellodarling1253@gmail.com" style="color:var(--accent-2); text-underline-offset:3px">hellodarling1253.com</a></p>
      </section>
    </div>
  </div>
</body>

</html>