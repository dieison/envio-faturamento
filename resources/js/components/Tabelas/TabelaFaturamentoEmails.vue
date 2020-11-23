<template>
  <div>
    <div class="form-row d-flex justify-content-end">
      <div class="col-md-4">
        <input v-model="searchText" type="text" placeholder="Pesquisar" class="form-control" />
      </div>
      <div class="col-md-2 d-flex justify-content-center">
        <a v-bind:href="url_relatorio" type="button" class="btn btn-primary">Exportar Tabela</a>
      </div>
    </div>
    <div class="table-responsive mt-2">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th class="text-center">Número Título</th>
            <th class="text-center">NOME</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">BANCO</th>
            <th class="text-center">TURNO</th>
            <th class="text-center">TIPO DE NOTA</th>
            <th class="text-center">STATUS</th>
            <th class="text-center">BOLETO</th>
            <th class="text-center">NOTA</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="boleto in pageOfItems" :key="boleto.cdrcd">
            <td class="text-center">{{boleto.cdrcd}}</td>
            <td class="text-center">{{boleto.nome}}</td>
            <td class="text-center">{{boleto.cnpj}}</td>
            <td class="text-center">{{boleto.banco}}</td>
            <td class="text-center">{{boleto.turno}}</td>
            <td class="text-center">{{boleto.tipo_nota}}</td>
            <td class="text-center">{{boleto.status}}</td>
            <td class="text-center">
              <a v-bind:href="'/api/get-boleto/'+boleto.cdrcd">
                <i class="fa fa-download fa-lg link" aria-hidden="true"></i>
              </a>
            </td>
            <td class="text-center">
              <a v-if="boleto.banco!=='CAIXA ECONOMICA FEDERAL'" v-bind:href="'/api/get-nota/'+boleto.cdrcd">
                <i class="fa fa-download fa-lg link" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row card-footer">
        <jw-pagination
          :items="filteredBoletos"
          @changePage="onChangePage"
          :labels="customLabels"
          :pageSize="15"
          :maxPages="18"
        ></jw-pagination>
      </div>
    </div>
  </div>
</template>
<script>
const customLabels = {
  first: "Primeira",
  last: "Última",
  previous: "Anterior",
  next: "Próxima",
};
export default {
  props: ["url_relatorio"],
  data() {
    return {
      boletos: [],
      pageOfItems: [],
      searchText: "",
      customLabels,
    };
  },
  mounted() {
    this.getFaturamento(null);
  },

  computed: {
    filteredBoletos() {
      return this.boletos.filter((boleto) => {
        let textoValid = true;

        if (this.searchText) {
          let searchText = this.searchText.toLowerCase();
          textoValid =
            boleto.nome.toLowerCase().includes(searchText) ||
            boleto.cnpj.toLowerCase().includes(searchText);
        }
        return textoValid;
      });
    },
  },

  methods: {
    getFaturamento() {
      this.$vs.loading();
      axios
        .get("/api/get-faturamento-email")
        .then((response) => {
          this.boletos = response.data;
          this.$vs.loading.close();
        })
        .catch((e) => {
          this.$vs.loading.close();
        });
    },

    onChangePage(pageOfItems) {
      this.pageOfItems = pageOfItems;
    },
  },
};
</script>

<style media="screen">
.btn-primary {
  color: #fff !important;
}
</style>