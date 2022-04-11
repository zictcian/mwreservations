<template>
  <NavMW></NavMW>
  <router-view/>
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="one_quarter first">
      <h6 class="title" style="color:dimgray">Contacto</h6>
      <address class="btmspace-30">
      Codigo postal
      <br>
      29058
      <br>
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><i class="fa fa-phone"></i> +521 (961) 123 68 17</li>
        <li><i class="fa fa-envelope-o"></i> walter@mwc.com.mx</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title" style="color:dimgray">MW Consultores</h6>
      <article>
        <time class="font-xs">Creador de</time>
        <h2 class="nospace font-x1"><a href="/">Express Trip</a></h2>
        <br>
        <p>Organización laboral y compañia moral.</p>
        <h2 class="nospace font-x1"><a href="https://mwc.com.mx/">https://mwc.com.mx/</a></h2>
      </article>
    </div>
    <div class="one_quarter">
      <h6 class="title" style="color:dimgray">Desarrollador</h6>
      <ul class="nospace linklist">
        <li><p href="#">Zictcian de Jesus MF</p></li>
        <li><a href="https://www.facebook.com/zictciandejesus.medinaflores.7" target="_blank"><i class="bi bi-facebook"> Facebook</i></a></li>
        <li><a href="https://api.whatsapp.com/send?phone=529613607535&text=Buen dia!" target="_blank"><i class="bi bi-whatsapp"> Telefono</i></a></li>
        <li><a href="https://www.linkedin.com/in/zictcian-de-jesus-medina-flores-511aa11ab/" target="_blank"><i class="bi bi-linkedin"> linkedin</i></a></li>
        <li><a href="mailto:zictcianz@gmail.com" target="_blank"><i class="bi bi-google"> Correo</i></a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title" style="color:dimgray">Oficinas en</h6>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.188219483504!2d-93.15365258513222!3d16.767308788452937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd911f2121f8f%3A0x1f6c10865f12a6b0!2sMW%20Consultores!5e0!3m2!1ses!2smx!4v1649426149628!5m2!1ses!2smx"
      style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- ################################################################################################ -->
  </footer>
  <FooterMWVue></FooterMWVue>
</template>

<script>
import NavMW from './components/NavMW.vue'
import FooterMWVue from './components/FooterMW.vue'
export default {
  name: 'App',
  components: { NavMW, FooterMWVue }
}
</script>

<style>
hr{
  color: black;
}
  form{
    width: 50%;
    border-color: black;
    border: black;
    background-color: white;
    margin-left: 25%;
    margin-top: 50px;
  }
  .forgot-password a{
    color: #167bff;
  }

  .forgot-password a{
    text-align: right;
    font-size: 13px;
    padding-top: 10px;
    color: #7f7d7d;
    margin: 0;
  }
  .custom-control-label{
    font-weight: 400;
  }
  .auth-wrapper h3{
    text-align: center;
    margin: 0;
    line-height: 1;
    padding-bottom: 20px;
  }
  .auth-wrapper.form-control:focus{
    border-color: #167bff;
    box-shadow: none;
  }
  .auth-inner{
    width: 450px;
    margin: auto;
    background: #ffffff;
    box-shadow: 0px 14px 60px rgba(34,35,58,0.2);
    padding: 40px 55px 45px 55px;
    border-radius: 15px;
    transition: all .3s;
  }
  .auth-wrapper{
    display: flex;
    justify-content: center;
    flex-direction: column;
    text-align: left;
  }
  .navbar-light{
    background-color: #ffffff;
    box-shadow: 0px 14px 80px rgba(34,35,58,0.2);
  }
  #app{
    text-align: center;
  }
  html,#app,#root,body{
    width: 100%;
    height: 100%;
  }
  h1,h2,h3{
    font-weight: 500;
    font-family: 'Helvetica', sans-serif;
  }
   h4,h5,h6{
    font-weight: 500;
    font-family: 'Verdana', sans-serif;
  }
  p{
    font-family: 'arial', sans-serif;
  }
 body{
    background: white;
    display: flex;
    font-family: 'Fira Sans', sans-serif;
  }
  * {
    box-sizing: border-box;
  }
</style>
