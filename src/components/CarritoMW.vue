<template>
    <h1>Registro de actividades<hr></h1>
    <div class="container fo">
    <h1 v-if="sitios== ''">No hay sitios registrados</h1>
    <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
  <div class="container">
    <div class="row" v-for="sitio in sitios" :key="sitio.id">
    <div class="card espacio" style="width: 24rem;">
      <img class="card-img-top" :src="sitio.logo" alt="Card image cap">
      <div class="card-body bodycard">
        <h3>Reservacion para {{sitio.personas}} personas</h3>
        <button :disabled="!sitio.idEstatus=='1'" class="btn btn-primary"><a style="color:white">Ver reservación</a></button>
      </div>
      <div class="card-footer">
      <small v-if="1" class="text-muted">Abierto</small> <br>
      {{sitio.ponderacion}} estrellas
      <div class="Row">
        <div v-for="n in 5" :key="n" class="gallery-outer">
        <i v-if="sitio.ponderacion>=n" class="bi bi-star-fill estrella"></i>
        <i v-else-if="sitio.ponderacion%1!=0 && n-1<sitio.ponderacion" class="bi bi-star-half estrella"></i>
        <i v-else class="bi bi-star estrella"></i>
      </div>
      </div>
    </div>
    </div>
    <div class="card espacio" style="">
  <div class="card-header textocard"><h4>{{sitio.nombre}}
    <span v-if="sitio.idEstatus=='1'" style="margin-left:35%" class="badge badge-pill badge-success">Activo</span>
    <span v-if="sitio.idEstatus!='1'" style="margin-left:35%" class="badge badge-pill badge-warning">Inactivo</span>
    </h4></div>
  <div class="card-body">
    <h5 class="card-title">Datos de descripción</h5>
    <table style="">
      <tbody class="tablacuerpo" style="background-color:white">
        <tr>
          <td style="width: 150px">Tiempo reservado</td>
          <td style="width: 550px">{{sitio.MinutosR}} Minutos</td>
        </tr>
        <tr>
          <td style="width: 150px">Fecha reservada</td>
          <td style="width: 550px">{{sitio.fecha}}</td>
        </tr>
        <tr>
          <td style="width: 150px">Hora reservada</td>
          <td style="width: 550px">
            <p v-if="sitio.hora.split(':')[0]>'12'">{{sitio.hora.split(':')[0]}}:{{sitio.hora.split(':')[1]}} pm</p>
            <p v-if="sitio.hora.split(':')[0]<'12'">{{sitio.hora.split(':')[0]}}:{{sitio.hora.split(':')[1]}} am</p>
          </td>
        </tr>
        <tr>
          <td style="width: 150px">Fecha de reporte</td>
          <td style="width: 550px">
            <p v-if="(sitio.registro.split(':')[0])>'12'">{{sitio.registro.split(':')[0]}}:{{sitio.hora.split(':')[1]}} pm</p>
            <p v-if="(sitio.registro.split(':')[0].split(' ')[1])<'12'">{{sitio.registro.split(':')[0]}}:{{sitio.hora.split(':')[1]}} am</p>
          </td>
        </tr>
        <tr>
          <td style="width: 150px">Descripción</td>
          <td style="width: 550px;"><textarea :disabled="true" v-model="sitio.descripcion" name="textarea" rows="4" cols="50"></textarea></td>
        </tr>
        <tr>
          <td style="width: 150px">Comentarios</td>
          <td style="width: 550px;"><textarea :disabled="true" v-model="sitio.comentario" name="textarea" rows="4" cols="50"></textarea></td>
        </tr>
      </tbody>
    </table>
    </div>
</div>
</div>
  </div>
</div>
</template>

<script>
export default {
  name: 'CarritoMW',
  data () {
    return {
      // user: [],
      sitios: []
    }
  },
  created: function () {
    this.traersitios()
  },
  methods: {
    traersitios () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('http://localhost/mwreservation/carrito.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.sitios = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.sitios = datosRespuest
        }
      }).catch(console.log)
    }
  }
}
</script>

<style scoped>
.fo{
  margin-bottom: 50px;
}
.col{
  padding-left: 5%;
  margin-left: 5%;
  padding-right: 5%;
  margin-right: 5%;
  margin-bottom: 5%;
}

.gallery-outer{
  display: inline-block;
  zoom: 1;
  text-align: center;
  vertical-align: top;
  margin-left: 5%;
}
.bodycard{
  height: 150px;
  width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
}
.textocard{
  overflow: ellipsis;
  text-align: left;
}
.estrella{
  color: red;
}

.espacio{
  height: 500px;
  width: 700px;
}
.tablacuerpo{
  text-align: left;
}
.tablacabeza{
  text-align: left;
}
</style>
