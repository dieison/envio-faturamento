<template>
  <div>
    <div class="table-responsive mt-2">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th class="text-center">CDRCD</th>
            <th class="text-center">DATA DE VENCIMENTO</th>
            <th class="text-center">VENCIMENTO PRORROGADO</th>
            <th class="text-center">VALOR</th>
            <th class="text-center">BANCO</th>
            <th class="text-center">SITUAÇÃO</th>
            <th class="text-center">BOLETO</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="boleto in boletos" :key="boleto.CdRcd">
            <td class="text-center">{{boleto.CdRcd}}</td>
            <td class="text-center">{{boleto.vencimento}}</td>
            <td class="text-center">{{boleto.vencimento_prorrogado}}</td>
            <td class="text-center">{{formataNumero(boleto.Valor)}}</td>
            <td class="text-center">{{boleto.banco}}</td>
            <td class="text-center">{{boleto.SituacaoBoleto}}</td>
            <td class="text-center">
              <a  v-if="boleto.nosso_numero" v-bind:href="'/api/get-boleto/'+boleto.CdRcd">
                <i class="fa fa-download fa-lg link" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id_cliente"],
  data() {
    return {
      boletos: {},
    };
  },
  mounted() {
    this.getBoletos();
  },

  methods: {
    getBoletos() {
      this.$vs.loading();
      axios
        .get("/api/get-boletos-cliente/" + this.id_cliente)
        .then((res) => {
          this.boletos = res.data;
          this.$vs.loading.close();
        })
        .catch((e) => {
          this.$vs.loading.close();
        });
    },
    formataNumero(numero) {
      return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
      }).format(numero);
    },
  },
};
</script>

<style media="screen">
.link {
  text-decoration: none;
  color: #212529;
}
</style>