<template>
    <van-back-top bottom="150px" />

    <van-search v-model="value" placeholder="请输入搜索关键词" />
    <van-notice-bar left-icon="volume-o" text="今日土豆牛腩汤加量不加价！小众点评打卡本店即可享受小份免费升大份！" />
    <van-row>
        <div style="width: 100%;">
            <van-card v-for="(item, index) in dishes" :key="index" :num="item.dish_weight" :price="item.dish_price"
                :desc="item.dish_des" :title="item.dish_name" :thumb="item.dish_img" :id="item.dish_id">
                <template #footer>
                    <van-button v-for="(button, buttonIndex) in item.buttons" :key="buttonIndex" size="mini">{{ button
                    }}</van-button>
                    <van-button size="mini" type="primary" @click="addToCart(item)">加入购物车</van-button>
                </template>
            </van-card>
        </div>
    </van-row>
    <van-submit-bar :price="3050" button-text="提交订单" @submit="onSubmit" style="margin-bottom: 50px;">
        <van-checkbox v-model="checked">全选</van-checkbox>
    </van-submit-bar>

    <Nav></Nav>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import 'vant/es/pull-refresh/style'
import 'vant/es/tabbar/style'
import 'vant/es/tabbar-item/style'
import 'vant/es/config-provider/style'
import 'vant/es/row/style'
import 'vant/es/icon/style'
import 'vant/es/image/style'
import 'vant/es/button/style'
import 'vant/es/field/style'
import 'vant/es/search/style'
import 'vant/es/notice-bar/style'
import 'vant/es/sidebar/style'
import 'vant/es/sidebar-item/style'
import 'vant/es/toast/style'
import 'vant/es/action-bar/style'
import 'vant/es/action-bar-icon/style'
import 'vant/es/action-bar-button/style'
import 'vant/es/submit-bar/style'
import 'vant/es/checkbox/style'
import 'vant/es/checkbox-group/style'
import 'vant/es/stepper/style'
import 'vant/es/swipe-cell/style'
import 'vant/es/card/style'
import 'vant/es/tag/style'
import 'vant/es/tree-select/style'
import 'vant/es/back-top/style'
import 'vant/es/cell/style'
import 'vant/es/cell-group/style'
import 'vant/es/submit-bar/style'
import Nav from '../components/Nav.vue';

export default {
    components: {
        Nav,
    },
    setup() {
        const value = ref('');
        const checked = ref(false);

        return {
            value,
            checked,
        };
    },
    data() {
        return {
            dishes: [],
        };
    },
    methods: {
        onSubmit() {
            Toast('提交订单');
        },
        getDishes() {
            const id = 1; // replace with the correct category id
            axios.get(`http://localhost/resphp/getDish.php?id=${id}`).then(response => {
                if (response.data.code === 1) {
                    this.dishes = response.data.data;
                }
            });
        },
        addToCart(dish) {
            dish.id = dish.dish_id;
            // TODO: add dish to cart
        },
    },
    mounted() {
        this.getDishes();
    },
};
</script>