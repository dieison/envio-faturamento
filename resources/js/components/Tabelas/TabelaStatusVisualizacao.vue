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
            <th class="text-center">STATUS</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="boleto in pageOfItems" :key="boleto.cdrcd">
            <td class="text-center">{{boleto.cdrcd}}</td>
            <td class="text-center">{{boleto.nome}}</td>
            <td class="text-center">{{boleto.cnpj}}</td>
            <td class="text-center">{{boleto.banco}}</td>
            <td class="text-center">{{boleto.status_visualizacao}}</td>
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
        .get("/api/get-status-visualizacao")
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