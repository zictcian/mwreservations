<template>
<body class="espacio">
<div class="container-fluid">
  <div class="contenedorimg">
<img :src="foto? foto:`https://plataforma.mwcomenius.com.mx/assets/perfil/nuevo.png`" alt="" class="imagenfoto"></div>
<div class="custom-file">
    <input :disabled="disabled" type="file" class="custom-file-input">
    <label class="custom-file-label" style="margin-left:37%;"><i class="bi bi-camera camara"></i></label>
  </div>
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
        <button v-on:Click="disabled = !disabled" :disabled="!email" class="btn btn-primary mb-2">Editar</button>
        <button :disabled="disabled" v-on:Click="postData" class="btn btn-primary mb-2">Modificar</button>
        </div>
    </div>
    <div class="cesion">
    <div class="card" style="width: 26rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="bi bi-person-square"></i> Cerrar sesión</li>
    <li class="list-group-item" v-if="email">{{email}}</li>
    <li class="list-group-item" v-if="!email"><a href="/login">Inicia sesión</a></li>
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
      foto: localStorage.getItem('foto'),
      password: '',
      passwordActual: '',
      passwordError2: '',
      disabled: true
    }
  },
  methods: {
    exit () {
      this.$swal.fire({
        title: '¡¡ ¿Te quieres quedar? !!',
        width: 600,
        padding: '3em',
        color: '#716add',
        background: '#fff',
        backdrop: `
          rgba(0,0,123,0.4)
          url("https://sweetalert2.github.io/images/nyan-cat.gif")
          left top
          no-repeat
        `,
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        showCloseButton: true,
        showLoaderOnConfirm: true
      }).then((result) => {
        if (!result.value) {
          localStorage.setItem('valor', '0')
          localStorage.setItem('nombre', '')
          localStorage.setItem('Apaterno', '')
          localStorage.setItem('Amaterno', '')
          localStorage.setItem('correo', '')
          localStorage.setItem('c', '')
          localStorage.setItem('foto', '')
          localStorage.setItem('zona', '')
          localStorage.setItem('zonaname', '')
          this.$router.push({ path: '/' })
        }
      })
    },
    async postData () {
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
      const passActual = await this.encryp(this.passwordActual)
      if (localStorage.getItem('c') !== passActual) {
        this.passwordError2 = this.passwordError2 + ' *La contraseña actual es erronea'
      }
      if (this.passwordError2 === '') {
        this.prueba()
      } else {
        this.$swal('error', 'Se detecto una inconsistencia', 'info')
      }
    },
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
    prueba () {
      this.$swal.fire({
        title: 'Verfificación',
        text: '¿Quieres alterar tus datos pesonales?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        showCloseButton: true,
        showLoaderOnConfirm: true
      }).then((result) => {
        if (result.value) {
          this.register()
        } else {
          this.$swal('Cancelado', 'operación cancelada', 'info')
        }
      })
    },
    async register () {
      const pass = await this.encryp(this.password)
      const passActual = await this.encryp(this.passwordActual)
      if (localStorage.getItem('c') === passActual) {
        const formdata = new FormData()
        formdata.append('idUsua', localStorage.getItem('valor'))
        formdata.append('correo', this.email)
        formdata.append('password', pass)
        formdata.append('nombre', this.nombre)
        formdata.append('Apaterno', this.Apaterno)
        formdata.append('Amaterno', this.Amaterno)
        formdata.append('validacion', passActual)
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
            this.$swal('Usuario alterado', 'Modificacion de datos personales', 'success')
            this.$router.push({ path: '/inicio' })
          } else {
            this.$swal('Error', 'Contraseña actual no es correcta', 'error')
          }
        }).catch(e => {
          console.log(e)
          this.$swal('Error', 'error al modificar', 'error')
        })
      }
    }
  }
}
</script>

<style scoped>
.espacio{
    font-family: 'Fira Sans', sans-serif;
}
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
.btn{
  margin-left: 45%;
}
.imagenfoto{
  height: 200px;
  width: 200px;
  position:absolute;
}
.camara:hover{
  color: rgb(255, 255, 255);
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
  background-color: rgb(233, 178, 150);
  align-content: center;
  align-items: center;
  margin-top: 25px;
  margin-left: 15%;
  margin-right: 15%;
}
.cesion{
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 70px;
}
.contenedorimg{
  height: 200px;
  width: 200px;
  margin-left: 40%;
  margin-top: 10px;
}
</style>
