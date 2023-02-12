<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width,initial-scale=1.0,maximum-scale=1.0"
    />
    <link
      href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,301,300,400&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
      integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://www.bookinglab.co/assets/global.css" />
    <title>Document</title>
    <style>
        :root {
  --color-body: #425466;
  --color-dark: #0A2540;
  --color-light: #DFE4EA;
  --color-custom: #425466;
  --color-primary: #5261F5;
  --container-padding: 1.5em;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

html, body, body > div {
  height: 100%;
  overflow: auto;
}

body {
  background-image: url("/assets/bg-gradient.svg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  font-size: 16px;
  font-family: "Satoshi", sans-serif;
}

input, button {
  border: none;
  outline: none;
}

input {
  display: block;
}

.bg-bottom-shape {
  height: 60vh;
  position: absolute;
  bottom: 0;
  width: 100%;
  overflow-x: hidden;
  z-index: -1;
}
.bg-bottom-shape img {
  display: block;
  min-width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
}

.container-px {
  padding-inline: var(--container-padding);
}

.container-py {
  padding-block: var(--container-padding);
}

.mb-1 {
  margin-bottom: 1em;
}

.ml-auto {
  margin-left: auto;
}

.btn {
  display: inline-block;
  background-color: var(--color-primary);
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 0.65em 0.9em;
  border-radius: 6px;
  text-decoration: none;
  text-align: center;
  cursor: pointer;
}
.btn.rounded {
  border-radius: 30px;
}

.page-logo {
  text-align: center;
  margin-top: 3.5em;
  margin-bottom: 3em;
}

.page-content {
  margin: 0 10em;
}

.sign-in-form-wrapper {
  display: flex;
  justify-content: center;
}

.sign-in-form {
  background: #FFFFFF;
  border: 1px solid #DFE4EA;
  box-shadow: 0px 100px 120px rgba(0, 0, 0, 0.12);
  border-radius: 12px;
  flex-grow: 1;
  max-width: 400px;
  padding: 36px;
  margin-bottom: 10em;
}
.sign-in-form .form-title {
  color: var(--color-dark);
  font-weight: 700;
  font-size: 36px;
  margin-bottom: 0.75em;
  letter-spacing: -0.035em;
}
.sign-in-form .reset-pwd-link {
  font-weight: 700;
  font-size: 13px;
  color: var(--color-body);
  text-decoration: none;
  letter-spacing: -0.01em;
  opacity: 0.8;
  margin-top: 0.25em;
}
.sign-in-form .reset-pwd-link:hover {
  opacity: 1;
}
.sign-in-form .form-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1.5em;
}
.sign-in-form .form-footer .link {
  font-weight: 700;
  font-size: 15px;
  color: var(--color-body);
  text-decoration: none;
}
.sign-in-form .form-footer .link a {
  color: var(--color-primary);
  text-decoration: none;
}
.sign-in-form .form-footer .link a:hover {
  text-decoration: underline;
}

.input-group label, .input-group input {
  display: block;
  width: 100%;
}
.input-group label {
  font-weight: 700;
  font-size: 12px;
  color: var(--color-body);
  margin-bottom: 0.5em;
  text-transform: uppercase;
}
.input-group input {
  border: 1px solid #DFE4EA;
  box-shadow: 0px 10.9041px 23.7908px rgba(0, 0, 0, 0.03);
  border-radius: 8px;
  height: 44px;
  padding: 0.5em 1em;
}

.password-strength-bar {
  margin: 0.5em 0;
  background-color: #DFE4EA;
  border-radius: 8px;
  height: 6px;
  display: none;
}
.password-strength-bar .password-strength-progress {
  height: 100%;
  border-radius: 6px;
  transition: width 0.3s;
}

.password-strength-info {
  display: none;
  font-weight: 500;
  font-size: 14px;
  color: var(--color-body);
}

.input-group .password-input {
  position: relative;
}
.input-group .password-input .icon {
  position: absolute;
  right: 1em;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}
.input-group .password-input input {
  padding-right: 3em;
}

.footer-col {
  flex-grow: 1;
}

.page-footer {
  background-color: #DFE4EA;
  padding: 2em 5em;
  border-radius: 1em;
  min-height: 145px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1em;
  margin-top: -5em;
}
.page-footer .powered-by-text {
  font-size: 16px;
  font-weight: 700;
  color: var(--color-body);
}

.footer-socials {
  display: flex;
  gap: 0.5em;
}
.footer-socials .social-item {
  --size: 42px;
  height: var(--size);
  width: var(--size);
  line-height: var(--size);
  font-size: 24px;
  text-align: center;
  border-radius: 50%;
  display: inline-block;
  background-color: var(--color-body);
  color: #FAFAFA;
}

.modal-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(46, 50, 53, 0.6);
  backdrop-filter: blur(10px);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-wrapper .modal-content {
  width: 95%;
  max-width: 325px;
  background: #FFFFFF;
  box-shadow: 0px 80px 100px rgba(0, 0, 0, 0.2);
  border-radius: 12px;
  padding: 1.5em;
}

.pwd-reset-content-modal {
  text-align: center;
}
.pwd-reset-content-modal .info {
  margin: 1em auto;
  max-width: 210px;
  font-weight: 700;
  font-size: 18px;
  line-height: 134%;
  color: var(--color-body);
}

#main {
  min-height: 100%;
  display: flex;
  flex-direction: column;
}
#main .footer-page-content {
  margin-top: auto;
  margin-bottom: var(--container-padding);
}

@media (max-width: 1300px) {
  .page-content {
    margin: 0 8em;
  }
}
@media (max-width: 1200px) {
  .page-content {
    margin: 0 6em;
  }
}
@media (max-width: 992px) {
  .page-content {
    margin: 0 4em;
  }
}
@media (max-width: 576px) {
  .sign-in-form .form-footer {
    flex-direction: column;
    gap: 1em;
  }
  .sign-in-form .form-footer .btn {
    justify-self: flex-start;
    width: 100%;
    padding: 0.75em;
  }
  .page-footer {
    flex-direction: column;
  }
  .page-content {
    margin: 0;
  }
  .page-content .col.main {
    border: none;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
}

/*# sourceMappingURL=global.css.map */
    </style>
    <style>
      .sign-in-form .form-footer {
        display: flex;
        justify-content: center !important;
        margin-top: 1.5em;
      }
      .social-item {
        text-align: center !important;
        justify-content: center;
        display: flex !important;
        margin: auto;
        flex-direction: column;
      }
    </style>
  </head>
  <body data-new-gr-c-s-check-loaded="14.1095.0" data-gr-ext-installed="">
    <div id="main">
      <div class="bg-bottom-shape">
        <img
          src="{{asset('uploads/bg-bottom-shape.png')}}"
          alt=""
        />
      </div>

      <div class="container-px container-py">
        <div class="page-logo">
          <img
            style="height: 100px;"
            src="https://uploads-ssl.webflow.com/630694b36b7b3e62bb1cb0a6/63125a5f08f13d65ae856b75_lab-group-white.svg"
            alt=""
          />
        </div>
        <div class="sign-in-form-wrapper">
          <div class="sign-in-form">
            <div class="form-title">Sign in</div>
            <div class="input-group mb-1">
              <label>Email address</label>
              <input type="text" placeholder="Enter your email address" />
            </div>

            <div class="smart-password-input" data-strengthcheck="disallowed">
              <div class="input-group">
                <label>Password</label>
                <div class="password-input">
                  <input type="password" placeholder="Enter your password" />
                  <i class="bi hide-show icon bi-eye"></i>
                </div>
              </div>
              <div class="password-strength-bar">
                <div class="password-strength-progress"></div>
              </div>
              <div class="password-strength-info">
                Password strength: <span></span>
              </div>
            </div>
            <!-- <a class="reset-pwd-link" href="reset.html">Forgot password?</a> -->

            <div class="form-footer">
              <button class="btn rounded">
                Sign in
                <i class="bi bi-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="page-content footer-page-content container-px">
        <div class="col footer-col main transparent">
          <div class="page-footer">
            <div class="footer-socials">
              <a href="#" target="_blank" class="social-item">
                <i class="bi bi-instagram"></i>
              </a>
              <a href="#" target="_blank" class="social-item">
                <i class="bi bi-twitter"></i>
              </a>
              <a href="#" target="_blank" class="social-item">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="#" target="_blank" class="social-item">
                <i class="bi bi-youtube"></i>
              </a>
            </div>
            <div class="powered-by-text">Powered by Menulab</div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://www.bookinglab.co/utils/passStrength.js"></script>
    <script src="https://www.bookinglab.co/assets/main.js"></script>
    <script src="https://img1.wsimg.com/traffic-assets/js/tccl.min.js"></script>
  </body>
  
  <script>
    const smartPwdInputs = [...document.querySelectorAll('.smart-password-input')]
    smartPwdInputs.forEach(i => createSmartPwdInput(i))

function createSmartPwdInput(el){
    const input = el.querySelector('input')
    const progressBar = el.querySelector('.password-strength-bar')
    const progress = progressBar.querySelector('.password-strength-progress')
    const info = el.querySelector('.password-strength-info')
    const pgTextEl =  info.querySelector('span')
    const eyeBtn = el.querySelector('.hide-show')
    const check = el.dataset.strengthcheck
    
    eyeBtn.addEventListener('click', function(){
        if(this.classList.contains('bi-eye')){
            this.classList.remove('bi-eye')
            this.classList.add('bi-eye-slash')
            input.setAttribute('type', 'text')
        }else{
            this.classList.remove('bi-eye-slash')
            this.classList.add('bi-eye')
            input.setAttribute('type', 'password')
        }
    })

    input.addEventListener('keyup', function(){
        if(check !== 'allow') return
        progressBar.style.display = 'block'
        info.style.display = 'block'

        const val = this.value.trim()
        const score = passStrength(val)

        if(score >= 90){
                pgTextEl.innerText = 'Very Secure'
                pgTextEl.style.color = '#5261F5'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#5261F5' 
            }else if(score >= 80){
                pgTextEl.innerText = 'Secure'
                pgTextEl.style.color = '#5261F5'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#5261F5' 
            }else if(score >= 70){
                pgTextEl.innerText = 'Very Strong'
                pgTextEl.style.color = '#6D9D5B'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#6D9D5B' 
            }else if(score >= 60){
                pgTextEl.innerText = 'Strong'
                pgTextEl.style.color = '#6D9D5B'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#6D9D5B' 
            }else if(score >= 50){
                pgTextEl.innerText = 'Average'
                pgTextEl.style.color = '#eeb12e'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#eeb12e' 
            }else if(score >= 30){
                pgTextEl.innerText = 'Weak'
                pgTextEl.style.color = '#CC686E'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#CC686E' 
            }else{
                pgTextEl.innerText = 'Very Weak'
                pgTextEl.style.color = '#CC686E'
                progress.style.width = score + '%'
                progress.style.backgroundColor = '#CC686E' 
            }
    })
}
  </script>
</html>

