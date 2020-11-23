<template>
  <div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label>Banco:</label>
        <select class="form-control" v-model="filtroBanco">
          <option disabled value>Selecione Um Banco</option>
          <option>BANCO ITAU SA</option>
          <option>BRADESCO</option>
          <option>CAIXA ECONOMICA FEDERAL</option>
          <option>SANTANDER</option>
        </select>
      </div>
    </div>
    <button
      type="button"
      class="btn btn-primary"
      v-on:click="getFaturamento(filtroBanco,selectAll=false,selected.length=0)"
    >Filtrar</button>
    <button
      type="button"
      class="btn btn-primary"
      v-on:click="getFaturamento(),filtroBanco='', selectAll=false,selected.length=0"
    >Limpar Filtro</button>
    <hr />
    <div v-if="selected.length>0" class="d-flex justify-content-end">
      <button
        type="button"
        class="btn btn-success"
        v-on:click="envioFaturamento(selected,turno)"
      >Começar Envio</button>
    </div>
    <div class="table-responsive mt-2">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="align-middle">
              <label class="form-checkbox">
                <input type="checkbox" v-model="selectAll" @click="select" />
                <i class="form-icon"></i>
              </label>
            </th>
            <th class="text-center">NOME</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">VALOR</th>
            <th class="text-center">BANCO</th>
            <th class="text-center">TIPO DE NOTA</th>
            <th class="text-center">TURNO</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="boleto in pageOfItems" :key="boleto.CdRcd">
            <th scope="row" class="align-middle">
              <input type="checkbox" :value="boleto.CdRcd" v-model="selected" />
            </th>
            <td class="text-center">{{boleto.Sacado}}</td>
            <td class="text-center">{{boleto.CNPJCPF_Sacado}}</td>
            <td class="text-center">{{formataNumero(boleto.Valor)}}</td>
            <td class="text-center">{{boleto.NmBco}}</td>
            <td class="text-center">{{boleto.tipo_nota}}</td>
            <td class="text-center">{{boleto.Turno}}</td>
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
        <sweet-modal ref="enviando" icon="warning" blocking>Enviando E-mails!!!</sweet-modal>
        <sweet-modal ref="sucesso" icon="success" blocking>E-mails Enviados com Sucesso!!!</sweet-modal>
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
  props:["turno"],
  data() {
    return {
      boletos: [],
      pageOfItems: [],
      searchText: "",
      customLabels,
      selectAll: false,
      selected: [],
      filtroBanco: "",
    };
  },
  mounted() {
    this.getFaturamento(null,this.turno);
  },

  computed: {
    filteredBoletos() {
      return this.boletos.filter((boleto) => {
        let textoValid = true;

        if (this.searchText) {
          let searchText = this.searchText.toLowerCase();
          textoValid =
            boleto.NmBco.toLowerCase().includes(searchText) ||
            boleto.tipo_nota.toLowerCase().includes(searchText);
        }
        return textoValid;
      });
    },
  },

  methods: {
    envioFaturamento(dados,turno) {
      this.$refs.enviando.open();
      if(turno=='turno-dia-5'){
        this.turno_faturamento='Turno dia 5'
      }
      if(turno=='turno-dia-15'){
        this.turno_faturamento='Turno dia 15'
      }
      if(turno=='turno-dia-25'){
        this.turno_faturamento='Turno dia 25'
      }
      axios
        .post("/api/envio-faturamento", {dados,turno:this.turno_faturamento})
        .then((response) => {
          let retorno = response.data;
          this.$refs.enviando.close();
           this.$refs.sucesso.open();
        })
        .catch((e) => {
          this.$refs.enviando.close();
        });
    },

    getFaturamento(banco,turno) {
      this.$vs.loading();
      if(turno=='turno-dia-5'){
        this.turno_faturamento='Turno dia 5'
      }
      if(turno=='turno-dia-15'){
        this.turno_faturamento='Turno dia 15'
      }
      if(turno=='turno-dia-25'){
        this.turno_faturamento='Turno dia 25'
      }
      axios
        .post("/api/get-faturamento", { banco: banco,turno:this.turno_faturamento })
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
    select() {
      this.selected = [];
      if (!this.selectAll) {
        for (let i in this.boletos) {
          this.selected.push(this.boletos[i].CdRcd);
        }
      }
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