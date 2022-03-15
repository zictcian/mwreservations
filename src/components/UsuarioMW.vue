<template>
<body class="espacio">
<div class="container-fluid">
    <div class="form-group forma">
        <h3 style="background-color: green">Datos personales<hr></h3>
        <div class="input-group mb-3">
            <label for="nombre">Nombre</label>
            <input :disabled="disabled" name="nombre" v-model="nombre" type="text" class="form-control inputwigth" placeholder="Nombre"/>
        </div>
        <div class="input-group mb-3">
            <label for="Apaterno">Apellido Paterno</label>
            <input :disabled="disabled" name="Apaterno" v-model="Apaterno" type="text" class="form-control inputwigth" placeholder="Primer apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Apellido Materno</label>
            <input :disabled="disabled" name="Amaterno" v-model="Amaterno" type="text" class="form-control inputwigth" placeholder="Segundo apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="email">Email</label>
            <input :disabled="disabled" name="email" v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="password">Cambiar password</label>
            <input :disabled="disabled" name="password" v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="passwordActual">Password actual</label>
            <input :disabled="disabled" name="passwordActual" v-model="passwordActual" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="inputwigth error"><span class="" v-if="passwordError2">{{passwordError2}}</span></div>
        <div class="btn-group inputwigth" role="group" aria-label="Basic example">
        <button v-on:Click="disabled = !disabled" :disabled="correo != ''" class="btn btn-primary mb-2">Editar</button>
        <button :disabled="disabled" v-on:Click="postData" class="btn btn-primary mb-2">Modificar</button>
        <button :disabled="!disabled" v-on:Click="postData" class="btn btn-primary mb-2">click</button>
        </div>
    </div>
    <div class="container-fluid cesion">
      <div class="card" style="width: 26rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="bi bi-person-square"></i> Cerrar seción</li>
    <li class="list-group-item" v-if="email">{{email}}</li>
    <li class="list-group-item" v-if="!email"><a href="/login">Inicia cesion</a></li>
    <li class="list-group-item"><button v-on:click="exit" class="btn btn-outline-danger"><i class="bi bi-x-octagon-fill"></i></button></li>
  </ul>
</div>
    </div>
</div>
</body>
</template>

<script>
export default {
  name: 'UsuarioMW',
  data () {
    return {
      nombre: localStorage.getItem('nombre'),
      Apaterno: localStorage.getItem('Apaterno'),
      Amaterno: localStorage.getItem('Amaterno'),
      email: localStorage.getItem('correo'),
      password: '',
      passwordActual: '',
      passwordError2: '',
      disabled: true
    }
  },
  methods: {
    exit () {
      this.$router.push({ path: '/' })
      localStorage.setItem('valor', '')
      localStorage.setItem('nombre', '')
      localStorage.setItem('Apaterno', '')
      localStorage.setItem('Amaterno', '')
      localStorage.setItem('correo', '')
      localStorage.setItem('c', '')
      alert('Vuelve pronto')
    },
    postData () {
      this.passwordError2 = ''
      if (this.email === '') {
        this.passwordError2 = this.passwordError2 + ' *El correo es obligatorio'
      }
      if (this.nombre === '') {
        this.passwordError2 = this.passwordError2 + ' *El nombre es obligatorio'
      }
      if (this.Apaterno === '') {
        this.passwordError2 = this.passwordError2 + ' *El apellido paterno es obligatorio'
      }
      if (this.password.length < 8) {
        this.passwordError2 = this.passwordError2 + ' *El password debe ser minimo 8 caracteres'
      } else if (this.password === this.nombre) {
        this.passwordError2 = this.passwordError2 + ' *El password no puede ser el nombre'
      }
      if (localStorage.getItem('c') !== this.passwordActual) {
        this.passwordError2 = this.passwordError2 + ' *La contraseña actual es erronea'
      }
      if (this.passwordError2 === '') {
        this.register()
      } else {
        alert('Error detectado')
      }
    },
    async register () {
      const formdata = new FormData()
      formdata.append('idUsua', localStorage.getItem('valor'))
      formdata.append('correo', this.email)
      formdata.append('password', this.password)
      formdata.append('nombre', this.nombre)
      formdata.append('Apaterno', this.Apaterno)
      formdata.append('Amaterno', this.Amaterno)
      formdata.append('validacion', this.passwordActual)
      await fetch('http://localhost/mwreservation/cambiardatos.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        if (datosRespuest != null) {
          this.error = false
          localStorage.setItem('valor', datosRespuest.id)
          localStorage.setItem('nombre', datosRespuest.nombre)
          localStorage.setItem('Apaterno', datosRespuest.Apaterno)
          localStorage.setItem('Amaterno', datosRespuest.Amaterno)
          localStorage.setItem('correo', datosRespuest.correo)
          localStorage.setItem('c', datosRespuest.passencryp)
          alert('usuario modificado')
          this.$router.push({ path: '/' })
        } else {
          alert('el correo ya esta registrado')
        }
      }).catch(e => {
        console.log(e)
        alert('Error al modificar')
      })
    }
  }
}
</script>

<style scoped>
.inputwigth{
    width: 60%;
    margin-left: 10px;
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
body{
    background-color: rgb(231, 227, 221);
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
.error{
  color: red;
  font-family: 'Times New Roman', Times, serif;
  font-size: 10px;
  margin-left: 25%;
  padding-top: 0%;
  margin-top: 0%;
}
.forma{
  background-color: antiquewhite;
  align-content: center;
  align-items: center;
  margin-top: 100px;
  margin-left: 15%;
  margin-right: 15%;
}
.cesion{
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 70px;
}
</style>
