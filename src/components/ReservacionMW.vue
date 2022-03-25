<template>
    <h1 v-if="false">No hay sitios registrados</h1>
    <i v-if="false" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <ul class="list-group-item list-group-item-success">Ubicacion</ul>
    <li class="list-group-item">{{sitios.ubicacion}}</li>
    <table class="table">
        <tbody>
            <tr>
                <td class="tablaimg">
                    <div class="text-center">
                       <img :src="sitios.logo" class="tablaimg">
                    </div>
                </td>
                <td>
                <iframe v-show="sitios.mapa != 'NA'" width="925" height="270"
                  :src="sitios.mapa">
                </iframe>
                <h3 v-show="sitios.mapa == 'NA'"><hr>No se ha podido cargar el mapa</h3>
                </td>
                <td class="fila2">
                    <li v-for="(horar,index) in splitedList(sitios.horario)" :key="horar" class="letra list-group-item">{{dias[index]}}: {{horar}}</li>
                </td>
            </tr>
        </tbody>
    </table>
    <div class=" fo">
  <div class="form-group delimitado">
        <h2><i class="bi bi-cart-check"></i> Realizar Reservacion</h2><hr>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">fecha</span>
        </div>
        <input v-model="fecha" type="date" class="form-control">
        </div>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">hora entrada</span>
        </div>
        <input v-model="entrada" type="time" class="form-control">
        </div>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">minutos reservados</span>
        </div>
        <input v-model="salida" type="number" class="form-control" placeholder="ejemplo: 120">
        </div>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">Personas</span>
        </div>
        <input v-model="personas" type="number" class="form-control" placeholder="ejemplo: 2">
        </div>
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">Comentario</span>
        </div>
        <textarea v-model="comentario" class="form-control" aria-label="With textarea" placeholder="ejemplo: Orden de nachos"></textarea>
        </div>
        <button v-on:click="probar" style="margin:15px" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Reservar</button>
        <button v-on:click="cancelar" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Cancelar</button>
  </div>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  name: 'ReservacionMW',
  data: function () {
    return {
      fecha: '',
      entrada: '',
      salida: '',
      personas: '',
      comentario: '',
      nombre: this.$route.params.id,
      id: this.$route.params.id,
      sitios: [],
      horarios: [],
      dias: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo']
    }
  },
  created: async function () {
    await this.traersitios()
  },
  methods: {
    splitedList (row) {
      return (row !== null) ? row.split(',') : ''
    },
    encryp: function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    desencryp: async function (palabra) {
      const palabradesencryp = atob(palabra)
      console.log(palabra)
      console.log(palabradesencryp)
      return palabradesencryp
    },
    async traersitios () {
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      formdata.append('Idsitio', sit)
      await fetch('http://localhost/mwreservation/prereserva.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        this.sitios = datosRespuest.sitio
        this.horarios = datosRespuest.horario
        console.log(datosRespuest.sitio)
        console.log(datosRespuest.horario)
      }).catch(console.log)
    },
    async cancelar () {
      this.$router.go(-1)
    },
    probar () {
      const dato = moment(new Date()).format('YYYY-MM-DD')
      console.log(dato, this.fecha)
      if (this.fecha > dato) {
        this.$swal('ok', 'correcto', 'succes')
      } else {
        this.$swal('ok', 'correcto', 'error')
      }
    },
    async realizarReservacion (comentario, minutosR, fecha, hora, personas) {
      const usua = localStorage.getItem('valor')
      if (usua !== '0') {
        const sit = await this.desencryp(this.id)
        const palabra = await this.encryp(usua + this.id + this.nombre + Date())
        const formdata = new FormData()
        formdata.append('IdSitio', sit)
        formdata.append('IdUsua', usua)
        formdata.append('comentario', comentario)
        formdata.append('minutosR', minutosR)
        formdata.append('fecha', fecha)
        formdata.append('hora', hora)
        formdata.append('personas', personas)
        formdata.append('qr', palabra)
        fetch('http://localhost/mwreservation/hacerreservacion.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest)
          try {
            if (datosRespuest !== 'error') {
              this.$swal('Exito', 'Reservación realizada', 'success')
              this.hacerpdf(comentario, minutosR, fecha, hora, personas)
              this.$router.push({ name: 'CarritoMW' })
            }
          } catch (e) {
          }
        }).catch(console.log)
      } else {
        this.$swal('Inicia sesión', 'operación anulada', 'info')
      }
    },
    reservar () {
      const usua = localStorage.getItem('valor')
      const dato = moment(new Date()).format('YYYY-MM-DD')
      console.log(this.fecha)
      if (usua !== '0') {
        if (this.personas > 0) {
          if (this.salida > 10) {
            if (this.fecha > dato) {
              this.$swal('ok', 'correcto', 'succes')
              this.realizarReservacion(this.comentario, this.salida, this.fecha, this.entrada, this.personas)
            } else {
              if (this.fecha === dato) {
                const hora = new Date().getHours()
                const minutos = new Date().getMinutes()
                const newhora = (hora + 1) + ':' + minutos
                console.log(newhora, this.entrada)
                if (this.entrada > newhora) {
                  this.$swal('ok', 'correcto', 'succes')
                  this.realizarReservacion(this.comentario, this.salida, this.fecha, this.entrada, this.personas)
                } else {
                  this.$swal('hora de reserva invalido', 'Tienes que reservar con una hora de anticipación', 'info')
                }
              } else {
                this.$swal('error de fecha', 'ingresa una fecha valida', 'info')
              }
            }
          } else {
            this.$swal('rango de hora invalido', 'la hora de salida tiene que ser mayor', 'info')
          }
        } else {
          this.$swal('ingresa una ponderacion valida', 'personas a registrar minimo 1', 'info')
        }
      } else {
        this.$swal('Inicia sesión', 'operación anulada', 'info')
      }
    }
  }
}
</script>

<style scoped>
.delimitado{
    margin-top: 25px;
    margin-left: 15%;
    margin-right: 15%;
    align-content: center;
    align-items: center;
    background-color: rgb(233, 178, 150);
    padding: 25px;
}
.tablaimg{
    height: 270px;
    width: 330px;
    position: relative;
}
.fila2{
    margin-left:0%;
    text-align:left;
    width: 270px;
}
.letra{
    font-size: xx-small;
    font-family: sans-serif;
}
.fo{
  padding-bottom: 50px;
}
</style>
