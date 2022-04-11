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
        <a class="btn2" v-on:click="a()"><i class="bi bi-envelope-exclamation-fill"> olvidaste tu contraseña?</i></a>
        <button id="buttonl" v-on:click="login" class="btn btn-primary mb-3">Login</button><br>
        <div class="btn2 btn-group" role="group">
          <a href="/register" style="margin-right:30px">Eres nuevo? crear cuenta</a>
          <a href="/newsitio" style="margin-left:30px">Únete y registra tu sitio</a>
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
          fetch('https://expresstrip.mwcomeniusdocente.com/app/enviarmail.php', {
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
      await fetch('https://expresstrip.mwcomeniusdocente.com/app/login.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        if (datosRespuest !== 'error') {
          if (typeof datosRespuest.usuario !== 'undefined') {
            console.log('sitio')
            this.error = false
            localStorage.setItem('valor', datosRespuest.usuario.id)
            localStorage.setItem('foto', datosRespuest.usuario.foto)
            localStorage.setItem('nombre', datosRespuest.usuario.nombre)
            localStorage.setItem('Apaterno', datosRespuest.usuario.Apaterno)
            localStorage.setItem('Amaterno', datosRespuest.usuario.Amaterno)
            localStorage.setItem('correo', datosRespuest.usuario.correo)
            localStorage.setItem('c', datosRespuest.usuario.passencryp)
            localStorage.setItem('cuenta', datosRespuest.usuario.idestatuscuenta)
            localStorage.setItem('nivel', '2')
            if (typeof datosRespuest.sitio !== 'undefined') {
              localStorage.setItem('local', datosRespuest.sitio.id)
              localStorage.setItem('Nlocal', datosRespuest.sitio.nombre)
              localStorage.setItem('sitiodato', datosRespuest.sitio)
            } else {
              this.error = true
            }
          } else {
            console.log('usuario')
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
.btn2{
  display: flex;
  text-align: center;
  vertical-align: top;
  margin: 0 0 1rem;
  align-items: start;
  justify-content: center;
}
.btn2:hover{
  text-decoration: underline;
}
.forma{
  background-color: rgb(242,247,235);
  margin-top: 100px;
  margin-left: 15%;
  margin-right: 15%;
}
</style>
