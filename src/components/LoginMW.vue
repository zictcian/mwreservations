<template>
<body>
<div class="container-fluid">
    <div class="form-group forma">
        <h3>Login</h3>
        <hr>
        <div class="input-group mb-3">
            <label for="">Email</label>
            <input v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Password</label>
            <input v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <button v-on:click="a" class="btn btn1">olvidaste tu contraseña?</button>
        <button v-on:click="login" class="btn btn-primary mb-3">Login</button><br>
        <a href="/register" class="btn1">Eres nuevo? crear cuenta</a>
    </div>
    </div>
    </body>
</template>

<script>
export default {
  name: 'LoginMW',
  data () {
    return {
      email: this.$route.params.email,
      password: '',
      error: null
    }
  },
  methods: {
    encryp: async function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    desencryp: function (palabra) {
      const palabradesencryp = atob(palabra)
      console.log(palabra)
      console.log(palabradesencryp)
      return palabradesencryp
    },
    async login () {
      const formdata = new FormData()
      formdata.append('correo', this.email)
      const pass = await this.encryp(this.password)
      formdata.append('pass', pass)
      await fetch('http://localhost/mwreservation/login.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        console.log(datosRespuest.id)
        if (datosRespuest != null) {
          this.error = false
          localStorage.setItem('valor', datosRespuest.id)
          localStorage.setItem('foto', datosRespuest.foto)
          localStorage.setItem('nombre', datosRespuest.nombre)
          localStorage.setItem('Apaterno', datosRespuest.Apaterno)
          localStorage.setItem('Amaterno', datosRespuest.Amaterno)
          localStorage.setItem('correo', datosRespuest.correo)
          localStorage.setItem('c', datosRespuest.passencryp)
        } else {
          this.error = true
        }
      }).catch(e => {
        console.log(e)
        this.error = true
      })
      /* localStorage.setItem('token', response.data.token) */
      if (this.error != null && this.error === false) {
        this.$router.push({ name: 'InicioMW' })
      } else {
        this.$swal('Alerta', 'Acceso denegado', 'info')
      }
    }
  }
}
</script>

<style scoped>
.inputwigth{
    width: 40%;
    margin-left: 10px;
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
body{
    background: url("../assets/image.png");
    background-repeat: no-repeat, repeat;
    background-position: center;
    background-size: cover;
    font-family: 'Fira Sans', sans-serif;
}
.btn{
  margin-left: 45%;
}
.btn1{
  margin-left: 40%;
  text-decoration: underline;
  text-align: center;
}
.btn1:hover{
  color: blue;
}
.forma{
  background-color: antiquewhite;
  align-content: center;
  align-items: center;
  margin-top: 100px;
  margin-left: 15%;
  margin-right: 15%;
}
</style>
