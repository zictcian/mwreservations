<template>
<body>
<div class="container-fluid">
    <div class="form-group forma">
        <h3 id="login">Login</h3>
        <hr>
        <div class="input-group mb-3">
            <label for="">Ingresa tu email</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            </div>
            <input id="email" v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div id="passwordL" class="input-group mb-3">
            <label for=""> Ingresa tu password</label>
            <div class="input-group-prepend">
              <span class="input-group-text">(*)</span>
            </div>
            <input v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <button id="buttonl" v-on:click="a()" class="btn btn1">olvidaste tu contraseña?</button>
        <button v-on:click="login" class="btn btn-primary mb-3">Login</button><br>
        <div class="btn2 btn-group" role="group">
          <a href="/register" class="btn-secondary" style="margin-right:30px">Eres nuevo? crear cuenta</a>
          <a href="/newsitio" class="btn-secondary" style="margin-left:30px">Únete y registra tu sitio</a>
        </div>
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
    async a () {
      return new Promise((resolve, reject) => {
        let timerInterval
        this.$swal.fire({
          title: 'Procesando reservacion',
          html: 'Procesando . . .',
          timer: 2500,
          timerProgressBar: true,
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
        /* Read more about handling dismissals below */
          if (result.dismiss === this.$swal.DismissReason.timer) {
            console.log('Reservacion realizada')
          }
        }).catch(console.log)
        if (this.email !== '' && typeof this.email !== 'undefined') {
          document.getElementById('buttonl').style.display = 'none'
          document.getElementById('passwordL').style.display = 'none'
          document.getElementById('login').innerHTML = 'Recordar password'
          const data = new FormData()
          data.append('correo', this.email)
          data.append('token', '54321')
          data.append('actividad', 'Recordar contraseña')
          fetch('http://localhost/mwreservation/enviarmail.php', {
            method: 'POST',
            body: data
          }).then(
            respuest => respuest.json()
          ).then(datosRespuest => {
            console.log(datosRespuest)
            if (datosRespuest === 'error') {
              this.$swal('Alerta', 'Correo no valido', 'error')
            } else {
              this.$swal('Correo enviado', 'Sí el correo no esta busca en span', 'info')
            }
          }).catch(console.log)
        } else {
          document.getElementById('buttonl').style.display = 'none'
          document.getElementById('passwordL').style.display = 'none'
          document.getElementById('login').innerHTML = 'Recordar password'
          this.$swal('Alerta', 'Ingresa el correo al que quieres recordar password', 'info')
        }
      })
    },
    async login () {
      this.error = true
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
        console.log(datosRespuest.idestatuscuenta)
        if (datosRespuest != null) {
          if (typeof datosRespuest.idestatuscuenta !== 'undefined') {
            console.log(datosRespuest.id)
            this.error = false
            localStorage.setItem('valor', datosRespuest.id)
            localStorage.setItem('foto', datosRespuest.foto)
            localStorage.setItem('nombre', datosRespuest.nombre)
            localStorage.setItem('Apaterno', datosRespuest.Apaterno)
            localStorage.setItem('Amaterno', datosRespuest.Amaterno)
            localStorage.setItem('correo', datosRespuest.correo)
            localStorage.setItem('c', datosRespuest.passencryp)
            localStorage.setItem('cuenta', datosRespuest.idestatuscuenta)
            localStorage.setItem('nivel', '1')
          } else if (typeof datosRespuest.idestatussitio !== 'undefined') {
            this.error = false
            localStorage.setItem('valor', datosRespuest.id)
            localStorage.setItem('foto', datosRespuest.foto)
            localStorage.setItem('nombre', datosRespuest.nombre)
            localStorage.setItem('Apaterno', datosRespuest.Apaterno)
            localStorage.setItem('Amaterno', datosRespuest.Amaterno)
            localStorage.setItem('correo', datosRespuest.correo)
            localStorage.setItem('c', datosRespuest.passencryp)
            localStorage.setItem('cuenta', datosRespuest.idestatuscuenta)
            localStorage.setItem('nivel', '2')
          } else {
            this.error = true
          }
        } else {
          this.error = true
        }
      }).catch(e => {
        console.log(e)
        this.error = true
      })
      /* localStorage.setItem('token', response.data.token) */
      if (!this.error) {
        await this.$router.push({ name: 'InicioMW' })
        this.$router.go(0)
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
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
body{
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
.btn2{
  display: flex;
  text-align: center;
  vertical-align: top;
  margin: 0 0 1rem;
  align-items: start;
  justify-content: center;
}
.btn1:hover{
  color: blue;
}
.forma{
  background-color: rgb(242,247,235);
  align-content: center;
  align-items: center;
  margin-top: 100px;
  margin-left: 15%;
  margin-right: 15%;
}
</style>
