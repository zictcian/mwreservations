<template>
  <NavMW></NavMW>
  <router-view/>
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
    background-color: antiquewhite;
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
    background: antiquewhite;
    display: flex;
    font-family: 'Fira Sans', sans-serif;
  }
  * {
    box-sizing: border-box;
  }
</style>
