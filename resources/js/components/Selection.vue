<template>
  <v-container fluid>
    <v-row>
      <v-col class="d-flex" cols="4" v-for="item in selectItems" :key="item.id">
        <v-select
          v-model="item.select"
          :items="item.items"
          item-text="value"
          item-value="id"
          :label="item.label"
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
    page: null,
    pageCount: null,
    itemsPerPage: null,
    selectItems: {
      model_ispolnenie: {
        id: 27,
        label: "Модель/исполнение",
        select: undefined,
        items: [
          { value: "Термоусаживаемая (-ый)", id: 483 },
          { value: "Прямолинейн.", id: 27 }
        ]
      },
      ne_soderjit_galogenov: {
        id: 26,
        label: "Не содержит (без) галогенов",
        select: undefined,
        items: [
          { value: "Нет", id: 494 },
          { value: "Да", id: 26 }
        ]
      },
      oblast_primeneniya: {
        id: 74,
        label: "Область (место) применения",
        select: undefined,
        items: [
          { value: "Вне помещений (наружн. установка)", id: 522 },
          { value: "Внутри помещений (внутр. установка)", id: 519 },
          {
            value: "Внутри и вне помещений (внутр. и наружн. установка)",
            id: 478
          }
        ]
      },
      sechenie_diapozon: {
        id: 75,
        label: "Номин. поперечное сечение (диапазон)",
        select: undefined,
        items: [
          { value: "800", id: 542 },
          { value: "240", id: 540 },
          { value: "4", id: 534 },
          { value: "4...10", id: 533 },
          { value: "95...240", id: 532 },
          { value: "35...70", id: 531 },
          { value: "185...400", id: 526 },
          { value: "25...70", id: 525 },
          { value: "500", id: 524 },
          { value: "70...150", id: 521 },
          { value: "120...240", id: 518 },
          { value: "630", id: 511 },
          { value: "400", id: 510 },
          { value: "300", id: 509 },
          { value: "25...50", id: 501 },
          { value: "150...240", id: 487 },
          { value: "70...120", id: 486 },
          { value: "35...50", id: 485 },
          { value: "16...25", id: 479 }
        ]
      },
      vinty_bolty_nakonechniki_gilzy: {
        id: 76,
        label: "С винтовыми/болтовыми наконечниками/гильзами",
        select: undefined,
        items: [
          { value: "Нет", id: 484 },
          { value: "Да", id: 480 }
        ]
      },
      uroven_napryajeniya: {
        id: 77,
        label: "Уровень напряжения",
        select: undefined,
        items: [
          { value: "6/10 кВ", id: 523 },
          { value: "3.6/6 кВ", id: 520 },
          { value: "0.6/1 кВ", id: 481 }
        ]
      },
      podhodit_dlya: {
        id: 78,
        label: "Подходит для",
        select: undefined,
        items: [
          { value: "Одножильного кабеля", id: 508 },
          { value: "Трехжильного кабеля", id: 482 },
          { value: "Четырехжильного кабеля", id: 500 },
          { value: "Пятижильного кабеля", id: 505 },
          { value: "Прочее", id: 493 }
        ]
      },
      dlya_soedineniya_s_bumajnoy: {
        id: 79,
        label:
          "Для соединения кабелей с бумажной (БПИ) и пластиковой изоляцией",
        select: undefined,
        items: [
          { value: "Нет", id: 498 },
          { value: "Да", id: 488 }
        ]
      },
      sechenie_provodnika: {
        id: 80,
        label: "Номин. поперечное сечение проводника",
        select: undefined,
        items: [
          { value: "800", id: 543 },
          { value: "240", id: 541 },
          { value: "4...6", id: 539 },
          { value: "1.5...2.5", id: 538 },
          { value: "95...150", id: 537 },
          { value: "50...95", id: 536 },
          { value: "16...50", id: 535 },
          { value: "240...400", id: 530 },
          { value: "120...240", id: 529 },
          { value: "70...150", id: 528 },
          { value: "35...70", id: 527 },
          { value: "25", id: 517 },
          { value: "630", id: 516 },
          { value: "500", id: 515 },
          { value: "400", id: 514 },
          { value: "300", id: 513 },
          { value: "25...50", id: 503 },
          { value: "150...240", id: 497 },
          { value: "70...120", id: 496 },
          { value: "35...50", id: 495 },
          { value: "16...25", id: 489 }
        ]
      },
      s_koncentricheskim_ekranirovaniem: {
        id: 81,
        label: "С концентрическим экранированием",
        select: undefined,
        items: [{ value: "Нет", id: 490 }]
      },
      utverjdena_sektorom: {
        id: 82,
        label: "Утверждена горнодобывающим промышленным сектором",
        select: undefined,
        items: [{ value: "Нет", id: 491 }]
      },
      kolichevstvo_provodnikov: {
        id: 73,
        label: "Количество проводников",
        select: undefined,
        items: [
          { value: "1", id: 507 },
          { value: "3", id: 477 },
          { value: "4", id: 499 },
          { value: "5", id: 504 }
        ]
      }
    },
    headers: [
      { text: "Артикул", value: "article" },
      { text: "Наименование", value: "name" },
      {
        text: "Номин. поперечное сечение (диапазон)",
        value: "sechenie_diapozon"
      },
      { text: "Номин. поперечное сечение проводника", value: "sechenie" },
      { text: "Уровень напряжения", value: "napryajenie" }
    ],
    products: []
  }),

  computed: {
    selectionArray() {
      let arr = {};

      for (let key in this.selectItems) {
        let item = this.selectItems[key];
        if (item.select) {
          arr[item.id] = item.select;
        }
      }

      return arr;
    }
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
      axios
        .post("/catalog/selection/search?page=" + page, {
          params: this.selectionArray
        })
        .then(res => {
          // console.log(res.data);
          // console.log("TEST 1: ", this.products);

          this.page = res.data.current_page;
          this.itemsPerPage = res.data.per_page;
          this.pageCount = Math.ceil(res.data.total / res.data.per_page);
          this.products = res.data.data;
          // console.log("TEST 2: ", this.products);
          this.getProps();
        });
    },

    reset() {
      for (let key in this.selectItems) {
        this.selectItems[key].select = undefined;
      }
      this.products = [];
    },

    getProps() {
      this.products.forEach(product => {
        product.properties.forEach(prop => {
          if (prop.id === 76) {
            product.sechenie_diapozon = prop.pivot.value;
          }
          if (prop.id === 78) {
            product.napryajenie = prop.pivot.value;
          }
          if (prop.id === 81) {
            product.sechenie = prop.pivot.value;
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
</style>