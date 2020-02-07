<template>
    <div
            class="items">
        <v-card
                :key="index"
                class="item"
                v-for="(item,index) in items"

        >
            <div class="icon"><img :alt="item.title" :src="item.icon"></div>
            <div class="title">{{item.title}}</div>
            <div class="text">{{item.text}}</div>


        </v-card>
    </div>
</template>

<script>
    export default {
        name: "HomeCarts",
        data() {
            return {
                items: [
                    {
                        title: 'Соответствуем качеству',
                        text: 'Качество продукции подтверждено сертификатами',
                        icon: '/storage/icon1.svg',
                    },
                    {
                        title: 'Консультируем на протяжении всего проекта',
                        text: 'Технические консультации и закрепленный менеджер',
                        icon: '/storage/icon2.svg',
                    },
                    {
                        title: 'Закрепляем проекты за автором',
                        text: 'Система защиты и бонусирования проектировщиков',
                        icon: '/storage/icon3.svg',
                    },
                    {
                        title: 'Обеспечиваем удобство проектирования',
                        text: 'Продукция интегрирована в популярное конструкторские программы',
                        icon: '/storage/icon4.svg',
                    },
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>
    .items {
        margin: 70px 50px auto;
        display: flex;
        justify-content: space-evenly;
    }

    .item {
        margin: 0 17px 0;
        display: grid;
        grid-template-columns: 90px 1fr;
        grid-template-rows: auto;
        padding: 10px;

        .icon {
            grid-column: 1/1;
            grid-row: 1/3;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .text {
            grid-column: 2/2;
            grid-row: 2/2;
        }

        .title {
            font-weight: 700;
            grid-column: 2/2;
            grid-row: 1/1;
        }
    }

</style>