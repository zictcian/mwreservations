<template>
<div class="container-fluid">
  <div class="contenedorimg">
<img :src="foto? foto:`https://plataforma.mwcomenius.com.mx/assets/perfil/nuevo.png`" alt="" class="imagenfoto"></div>
<div class="custom-file">
    <input :disabled="disabled" type="file" class="custom-file-input">
    <label class="custom-file-label" style="margin-left:40%;"><i class="bi bi-camera camara"></i></label>
  </div>
    <div class="form-group forma">
        <h3>Datos personales<hr></h3>
        <div class="input-group mb-3">
            <label for="Apaterno">Nombre</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disabled">Desactivado</span><span class="input-group-text" v-show="!disabled"> *Activado ##</span>
          </div>
            <input :disabled="disabled" name="nombre" v-model="nombre" type="text" class="form-control inputwigth" placeholder="Nombre"/>
        </div>
        <div class="input-group mb-3">
            <label for="Apaterno">Apellido Paterno</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disabled">Desactivado</span><span class="input-group-text" v-show="!disabled"> *Activado ## </span>
          </div>
            <input :disabled="disabled" name="Apaterno" v-model="Apaterno" type="text" class="form-control inputwigth" placeholder="Primer apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Apellido Materno</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disabled">Desactivado</span><span class="input-group-text" v-show="!disabled"> *Activado ##</span>
          </div>
            <input :disabled="disabled" name="Amaterno" v-model="Amaterno" type="text" class="form-control inputwigth" placeholder="Segundo apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="email">Email</label>
          <div class="input-group-prepend">
            <span class="input-group-text">Desactivado</span>
          </div>
            <input :disabled="true" name="email" v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="password">Cambiar password</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disabled">Desactivado</span><span class="input-group-text" v-show="!disabled"> *Activado ## </span>
          </div>
            <input :disabled="disabled" name="password" v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="passwordActual">Password actual</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disabled">Desactivado</span><span class="input-group-text" v-show="!disabled">*[ Verificar ]*</span>
          </div>
            <input :disabled="disabled" name="passwordActual" v-model="passwordActual" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="inputwigth error"><span class="" v-if="passwordError2">{{passwordError2}}</span></div>
        <div class="btn-group btn-group-toggle">
          <button v-on:Click="disabled = !disabled" :disabled="!email" class="btn btn-primary"><i class="bi bi-pencil-square"></i>Editar datos</button>
          <button :disabled="disabled" v-on:Click="postData" class="btn btn-primary"><i class="bi bi-cloud-upload"></i>Modificar usuario</button>
        </div>
    </div>
</div>
<div class="espacio" v-show="cliente=='2'">
<div class="container-fluid">
    <div class="form-group forma">
        <h3>Datos empresariales {{sitios.nombre}}<hr></h3>
        <div class="input-group mb-3">
            <label for="Apaterno">Nombre</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
            <input v-model="sitios.nombre" :disabled="disable" type="text" class="form-control inputwigth" placeholder="Example: Restaurante la flour"/>
        </div>
        <div class="input-group mb-3">
            <label for="Apaterno">Ubicación</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ## </span>
          </div>
            <input v-model="sitios.ubicacion" :disabled="disable" type="text" class="form-control inputwigth" placeholder="Example: Colonia mexico, codigo postal: 00000, calles: 1 y 2"/>
        </div>
        <div class="input-group mb-3">
          <label for="Apaterno">Categoria</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <select :disabled="disable" class="custom-select inputwigth" id="catselected">
            <option selected></option>
            <option :value="index" v-for="(cat ,index) in categorias" :key="index">{{index+1}}. {{cat.categoria}}</option>
          </select>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Anticipo</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
            <input v-model="sitios.anticipo" :disabled="disable" type="number" min="0" class="form-control inputwigth" placeholder="Example: 150"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Descripción</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea v-model="sitios.descripcion" :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: Para una buena reunión familiar"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="email">Ponderación</label>
          <div class="input-group-prepend">
            <span class="input-group-text">Desactivado</span>
          </div>
            <input v-model="sitios.ponderacion" :disabled="true" type="number" class="form-control inputwigth" placeholder="Ponderación"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Horario</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea v-model="sitios.horario" :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: 10:00-12:00"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Teléfono</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <input v-model="sitios.telefono" :disabled="disable" type="number" class="form-control inputwigth" placeholder="Example: 96XXXXXXXX"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Límite</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <input v-model="sitios.limite" :disabled="disable" type="number" class="form-control inputwigth" placeholder="¿Cuantas lugares (mesas, asientos, cupo)? Example: 3 ó NA"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno"><a href="https://www.google.com/maps/" target="_blanck">Mapa <i class="bi bi-map"></i></a></label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea v-model="sitios.mapa" :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Traé el mapa de tu local"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">¿Que harán?</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea v-model="sitios.que_haras" :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: comer la mas deliciosa comida"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">En detalle</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: puedes ordenar comida con el personal"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Incluye</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: servicio al cliente, entrada de cortesía"></textarea>
        </div>
        <div class="input-group mb-3">
          <label for="Apaterno">No apto para</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <select :disabled="disable" class="custom-select inputwigth" id="noaptoselected">
            <option>NA</option>
            <option>Menores de 10 años</option>
            <option>Mayores de 90 años</option>
            <!-- <option :value="index" v-for="(zona ,index) in zonas" :key="index">{{index+1}}. {{zona.estado}}</option> -->
          </select>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Precauciones por Covid-19</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: gel anti-bacterial, areás del local limpias"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Requisitos por Covid-19</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: uso de cubrebocas"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">¿Que llevar?</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: Dinero"></textarea>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">No permitido</label>
          <div class="input-group-prepend">
            <span class="input-group-text" v-show="disable">Desactivado</span><span class="input-group-text" v-show="!disable"> *Activado ##</span>
          </div>
          <textarea :disabled="disable" class="form-control inputwigth" aria-label="With textarea" placeholder="Example: uso de gorras, uso de chanclas"></textarea>
        </div>
        <div class="inputwigth error"><span class="" v-if="passwordError1">{{passwordError1}}</span></div>
        <div class="btn-group">
          <button v-on:Click="disable = !disable" :disabled="!email" class="btn btn-primary"><i class="bi bi-pencil-square"></i>Editar datos</button>
          <button :disabled="disable" v-on:Click="postData2" class="btn btn-primary"><i class="bi bi-cloud-upload"></i>Modificar sitio</button>
        </div>
</div>
    </div>
</div>
<div class="cesion">
    <div class="card" style="width: 26rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="bi bi-person-square"></i> Cerrar sesión</li>
    <li class="list-group-item" v-if="email">{{email}}</li>
    <li class="list-group-item" v-if="!email"><a href="/login">Inicia sesión</a></li>
    <li class="list-group-item"><button :disabled="!email" v-on:click="exit" class="btn btn1 btn-outline-danger"><i class="bi bi-x-octagon-fill"></i></button></li>
  </ul>
</div>
    </div>
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
      passwordError1: '',
      passwordError2: '',
      categorias: [],
      sitios: [{
        nombre: '',
        ubicacion: '',
        logo: '',
        idcategoria: '',
        anticipo: '',
        descripcion: '',
        ponderacion: '',
        horario: '',
        telefono: '',
        idEstado: '',
        limite: '',
        mapa: '',
        que_haras: '',
        en_detalle: '',
        incluye: '',
        no_apto_para: '',
        covid_precauciones: '',
        covid_requisitos: '',
        que_llevar: '',
        no_permitido: ''
      }],
      disabled: true,
      disable: true,
      cliente: ''
    }
  },
  created: function () {
    this.cliente = localStorage.getItem('nivel')
    console.log(this.cliente)
    console.log(this.nombre)
    if (this.cliente === '2') {
      console.log('this.cliente')
      this.traersitios()
      this.traercat()
    }
  },
  methods: {
    traercat () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('https://expresstrip.mwcomeniusdocente.com/app/categorias.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.categorias = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.categorias = datosRespuest
        }
      }).catch(console.log)
    },
    async traersitios () {
      const sit = localStorage.getItem('valor')
      console.log(sit)
      const formdata = new FormData()
      formdata.append('id', sit)
      fetch('https://expresstrip.mwcomeniusdocente.com/app/getsitio.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.sitios = []
        if (typeof datosRespuest.success === 'undefined') {
          this.sitios = datosRespuest
        }
      }).catch(console.log)
    },
    splitedList (row) {
      return (row !== null) ? row.split(',') : ''
    },
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
      }).then(async (result) => {
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
          localStorage.setItem('nivel', '')
          localStorage.setItem('cuenta', '')
          localStorage.setItem('local', '')
          localStorage.setItem('Nlocal', '')
          localStorage.setItem('sitiodato', '')
          await this.$router.push({ path: '/' })
          this.$router.go(0)
        }
      })
    },
    async postData2 () {
      this.passwordError1 = ''
      if (this.email === '') {
        this.passwordError1 = this.passwordError1 + ' *El correo es obligatorio'
      }
      if (this.passwordError1 === '') {
        // this.prueba()
        this.$swal('En creación', 'Operación aún no valida', 'info')
      } else {
        this.$swal('error', 'Se detecto una inconsistencia', 'info')
      }
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
        formdata.append('password', pass)
        formdata.append('nombre', this.nombre)
        formdata.append('Apaterno', this.Apaterno)
        formdata.append('Amaterno', this.Amaterno)
        formdata.append('validacion', passActual)
        await fetch('https://expresstrip.mwcomeniusdocente.com/app/cambiardatos.php', {
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
    margin-left: 0px;
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
.btn1{
  justify-content: center;
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
.btn-group button {
  padding: 10px 24px;
  cursor: pointer;
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
  background-color: rgb(242,247,235);
  align-content: center;
  align-items: center;
  margin-top: 25px;
  margin-left: 15%;
  margin-right: 15%;
}
.cesion{
  padding-top: 10px;
  display:inline-block;
  text-align: left;
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
