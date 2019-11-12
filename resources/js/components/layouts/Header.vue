<template>
  <div>
    <nav class="navbar is-fixed-top">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item">
          <img :src="photo + '/image/find-uni-navbar.png'" alt="Logo">
        </a>
        <span class="navbar-burger burger" data-target="finduninavmenu">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </div>
      <div id="finduninavmenu" class="navbar-menu">
        <div class="navbar-end">
          <a :href="home" class="navbar-item is-active">
            Home
          </a>
          <a :href="home + '/university'" class="navbar-item">
            All University
          </a>
          <a class="navbar-item modal-button" aria-haspopup="true" @click="modal_login = !modal_login">
            Login
          </a>
          <span class="navbar-item">
            <a class="button is-outlined modal-button" aria-haspopup="true" @click="modal_register = !modal_register">
              Register
            </a>
          </span>
        </div>
      </div>
    </div><!--/container-->
  </nav>

    <!-- LOGIN -->
    <transition enter-active-class="animated fadeIn faster" leave-active-class="animated fadeOut faster" mode="out-in">
  <div class="modal is-active" v-if="modal_login">
    <div class="modal-background"></div>
    <div class="modal-card w-365">
      <header class="modal-card-head bor-bot-0 has-background-white">
        <button class="delete is-medium m-l-auto" aria-label="close" @click="modal_login = !modal_login"></button>
      </header>
      <section class="modal-card-body p-t-0 p-b-0">
        <!--Login Form-->
        <form class="p-r-20 p-b-20 p-l-20">
          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Email</label>
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="email" placeholder="Email">
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
            </div><!--/control has-icons-->
          </div><!--/control-->

          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Password</label>
            <p class="control has-icons-left has-icons-right">
              <input class="input" type="password" placeholder="Password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div><!--/control-->

          <div class="field m-t-12">
            <label class="checkbox">
              <input type="checkbox">
              <span class="is-size-7 has-text-weight-normal">Remember Me</span>
            </label>
            <span class="is-pulled-right">
              <a class="is-pulled-right is-size-7 has-text-grey">Forgot Password?</a>
            </span>
          </div><!--/field-->

          <p class="title has-text-centered">
            <button class="button is-link has-text-centered is-fullwidth" type="submit">Sign In</button>
          </p>
        </form>

        <p class="has-text-centered is-size-7">By <b>Sign in</b> to this website you agree with<br>Find UNI's
          <a>Terms of Service</a> & <a>Privacy Policy</a>.
        </p>
        <!--Login Form-->
      </section>

      <footer class="has-text-centered modal-card-foot bor-top-0 has-background-white">
        <p class="is-size-7 m-l-r-auto">Don't have an account ?
          <a href="#" class="has-text-grey modal-button" data-target="modal-register" aria-haspopup="true">Register</a>.
        </p>
      </footer>
    </div><!--/modal-card-->
  </div><!--/modal-->
    </transition>
  <!--/LOGIN-->

  <!--REGISTER-->
    <transition enter-active-class="animated fadeIn faster" leave-active-class="animated fadeOut faster" mode="out-in">
  <div class="modal is-active" v-if="modal_register">
    <div class="modal-background"></div>
    <div class="modal-card w-365">
      <header class="modal-card-head bor-bot-0 has-background-white">
        <button class="delete is-medium m-l-auto" aria-label="close" @click="modal_register = !modal_register"></button>
      </header>
      <section class="modal-card-body p-t-0 p-b-0">
        <!--Register Form-->
        <form class="p-r-20 p-b-20 p-l-20">
          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Name</label>
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="text" placeholder="Name">
              <span class="icon is-small is-left">
                <i class="far fa-user"></i>
              </span>
            </div><!--/control has-icons-->
          </div><!--/field-->

          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Email</label>
            <div class="control has-icons-left has-icons-right">
              <input class="input" type="email" placeholder="Email">
              <span class="icon is-small is-left">
                <i class="far fa-envelope"></i>
              </span>
            </div><!--/control has-icons-->
          </div><!--/field-->

          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Password</label>
            <p class="control has-icons-left has-icons-right">
              <input class="input" type="password" placeholder="Password">
              <span class="icon is-small is-left">
                <i class="far fa-lock"></i>
              </span>
            </p>
          </div><!--/field-->

          <div class="field">
            <label class="label is-size-7 has-text-weight-normal">Confirmation Password</label>
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Confirm Password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div><!--/field-->

          <div class="field">
            <div class="control">
              <label class="checkbox">
                <input type="checkbox">
                <span class="is-size-7 has-text-weight-normal">I agree to the</span>
                <a class="is-size-7 has-text-weight-normal">terms and conditions</a>
              </label>
            </div><!--/control-->
          </div><!--/field-->

          <p class="title has-text-centered">
            <button class="button is-link has-text-centered is-fullwidth" type="submit">Register</button>
          </p>
        </form>
        <!--Register Form-->
      </section>

      <footer class="has-text-centered modal-card-foot bor-top-0 p-t-0 has-background-white">
        <p class="is-size-7 m-l-r-auto">Already have an account ?
          <a href="#" class="has-text-grey modal-button" data-target="modal-login" aria-haspopup="true">Login</a>.
        </p>
      </footer>
    </div><!--/modal-card-->
  </div><!--/modal-->
    </transition>
  <!--/REGISTER-->

  </div>
</template>

<script>
export default{
  props:['photo','home'],
  data(){
    return{
      modal_login:false,
      modal_register:false,
    }
  },
}
</script>

