<template>
  <v-container fluid v-if="loading">
    <v-row justify="center">
      <v-progress-circular :size="70" :width="7" color="purple" indeterminate></v-progress-circular>
    </v-row>
  </v-container>
  <v-container fluid v-else>
    <v-row>
      <v-col class="d-flex" cols="4" v-for="item in selectItems" :key="item.id">
        <v-select
          v-model="item.select"
          :items="item.values"
          item-text="value"
          item-value="id"
          :label="item.name"
          dense
          outlined
          clearable
        ></v-select>
      </v-col>
    </v-row>
    <hr />
    <div class="buttons">
      <v-btn color="primary" @click="submit">Поиск</v-btn>
      <v-btn color="primary" @click="reset" outlined>Сбросить</v-btn>
    </div>
    <hr />
    <v-data-table
      dense
      :headers="headers"
      :items="products"
      :items-per-page="itemsPerPage"
      hide-default-footer
      item-key="name"
      class="elevation-1"
    ></v-data-table>
    <v-pagination v-if="products.length" v-model="page" :length="pageCount" :total-visible="10"></v-pagination>
  </v-container>
</template>

<script>
export default {
  name: "Selection",
  data: () => ({
    loading: true,
    page: null,
    pageCount: null,
    itemsPerPage: null,
    selectItems: [],
    products: [],
    headers: [
      { text: "Артикул", value: "article" },
      { text: "Тип изделия", value: "tip_izdelia" },
      { text: "Вид изделия", value: "vid_izdelia" },
      { text: "Материал изоляции", value: "material_izolyacii" },
      { text: "Тип муфты", value: "tip_mufty" },
      { text: "Количество жил", value: "chislo_jil" },
      { text: "Сечение кабеля, мм2", value: "sechenie" },
      {
        text: "Наличие защитного слоя в кабеле",
        value: "zaschitniy_sloy"
      },
      { text: "Комплект заземления", value: "komplekt_zazemleniya" },
      { text: "Бренд", value: "brand" }
    ]
  }),

  mounted() {
    axios
      .get("/catalog/selection/properties")
      .then(res => {
        this.selectItems = res.data;
        this.selectItems.forEach(item => {
          item.select = undefined;
        });
        this.loading = false;
      })
      .catch(err => {
        console.log(err);
      });
  },

  watch: {
    page: function(val) {
      this.search(val);
    }
  },

  methods: {
    submit() {
      this.search(1);
    },

    search(page) {
      let params = this.getRequestParams();
      console.log(params);
      axios
        .post("/catalog/selection/search?page=" + page, {
          params: params
        })
        .then(res => {
          this.page = res.data.current_page;
          this.itemsPerPage = res.data.per_page;
          this.pageCount = Math.ceil(res.data.total / res.data.per_page);
          this.products = res.data.data;

          this.getProps();
        });
    },

    getRequestParams() {
      let body = {};

      this.selectItems.forEach(item => {
        if (item.select) {
          body[item.id] = item.select;
        }
      });

      return body;
    },

    reset() {
      this.selectItems = this.selectItems.map(item => {
        return { ...item, select: undefined };
      });

      this.products = [];
    },

    getProps() {
      this.products.forEach(product => {
        product.properties.forEach(prop => {
          switch (prop.name) {
            case "Артикул": {
              product.article = prop.pivot.value;
              break;
            }
            case "Тип изделия": {
              product.tip_izdelia = prop.pivot.value;
              break;
            }
            case "Вид изделия": {
              product.vid_izdelia = prop.pivot.value;
              break;
            }
            case "Тип изоляции": {
              product.material_izolyacii = prop.pivot.value;
              break;
            }
            case "Тип муфты": {
              product.tip_mufty = prop.pivot.value;
              break;
            }
            case "Количество жил": {
              product.chislo_jil = prop.pivot.value;
              break;
            }
            case "Сечение кабеля, мм2": {
              product.sechenie = prop.pivot.value;
              break;
            }
            case "Наличие защитного слоя в кабеле": {
              product.zaschitniy_sloy = prop.pivot.value;
              break;
            }
            case "Комплект заземления": {
              product.komplekt_zazemleniya = prop.pivot.value;
              break;
            }
            case "Бренд": {
              product.brand = prop.pivot.value;
              break;
            }
          }
        });
      });
    }
  }
};
</script>

<style scoped>
.buttons {
  display: flex;
  justify-content: center;
}
.v-btn {
  margin-left: 10px;
  margin-right: 10px;
}
.v-pagination {
  margin-top: 20px;
}
.v-progress-circular {
  margin: 25px;
}
</style>