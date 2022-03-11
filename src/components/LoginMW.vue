<template>
<body>
<div class="container-fluid">
    <form>
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
        <button v-on:click="login" class="btn btn-primary mb-3">Login</button>
    </form>
    </div>
    </body>
</template>

<script>
export default {
  name: 'LoginMW',
  data () {
    return {
      email: '',
      password: '',
      error: null
    }
  },
  methods: {
    async login () {
      const formdata = new FormData()
      formdata.append('correo', this.email)
      formdata.append('pass', this.password)
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
        alert('Acceso denegado')
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
</style>
