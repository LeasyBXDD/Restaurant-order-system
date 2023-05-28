<template>
    <van-back-top bottom="150px" />

    <van-search v-model="value" placeholder="请输入搜索关键词" />
    <van-notice-bar left-icon="volume-o" text="小众点评打卡本店即可获赠冰粉一份！仅限本周！" style="margin-bottom: 12px;" />

    <van-row>
        <van-tabs v-model:active="active" @click-tab="onClickTab" type="card" style="width: 100%;">
            <van-tab title="主食">
                <div style="width: 100%;">
                    <van-card v-for="(item, index) in dishes1" :key="index" :num="item.dish_weight" :price="item.dish_price"
                        :desc="item.dish_des" :title="item.dish_name" :thumb="item.dish_img" :id="item.dish_id">
                        <template #thumb>
                            <img :src="item.dish_img" style="width: 100%; height: 100%;" />
                        </template>
                        <template #tags>
                            <van-tag plain type="primary">{{ item.dish_nutrition_id }}</van-tag>
                        </template>
                        <template #footer>
                            <van-button size="mini" type="primary" @click="addToCart(item)">加入购物车</van-button>
                            <van-button size="mini" type="danger" @click="removeFromCart(item)">移除</van-button>
                        </template>
                    </van-card>
                </div>
            </van-tab>
            <van-tab title="川菜">
                <div style="width: 100%;">
                    <van-card v-for="(item, index) in dishes2" :key="index" :num="item.dish_weight" :price="item.dish_price"
                        :desc="item.dish_des" :title="item.dish_name" :thumb="item.dish_img" :id="item.dish_id">
                        <template #thumb>
                            <img :src="item.dish_img" style="width: 100%; height: 100%;" />
                        </template>
                        <template #footer>
                            <van-button size="mini" type="primary" @click="addToCart(item)">加入购物车</van-button>
                            <van-button size="mini" type="danger" @click="removeFromCart(item)">移除</van-button>
                        </template>
                    </van-card>
                </div>
            </van-tab>
            <van-tab title="粤菜">
                <div style="width: 100%;">
                    <van-card v-for="(item, index) in dishes3" :key="index" :num="item.dish_weight" :price="item.dish_price"
                        :desc="item.dish_des" :title="item.dish_name" :thumb="item.dish_img" :id="item.dish_id">
                        <template #thumb>
                            <img :src="item.dish_img" style="width: 100%; height: 100%;" />
                        </template>
                        <template #footer>
                            <van-button size="mini" type="primary" @click="addToCart(item)">加入购物车</van-button>
                            <van-button size="mini" type="danger" @click="removeFromCart(item)">移除</van-button>
                        </template>
                    </van-card>
                </div>
            </van-tab>
            <van-tab title="饮品">
                <div style="width: 100%;">
                    <van-card v-for="(item, index) in dishes4" :key="index" :num="item.dish_weight" :price="item.dish_price"
                        :desc="item.dish_des" :title="item.dish_name" :thumb="item.dish_img" :id="item.dish_id">
                        <template #thumb>
                            <img :src="item.dish_img" style="width: 100%; height: 100%;" />
                        </template>
                        <template #footer>
                            <van-button size="mini" type="primary" @click="addToCart(item)">加入购物车</van-button>
                            <van-button size="mini" type="danger" @click="removeFromCart(item)">移除</van-button>
                        </template>
                    </van-card>
                </div>
            </van-tab>
        </van-tabs>
    </van-row>

    <van-submit-bar :price="parseFloat(cartTotalPrice * 100)" button-text="提交订单" @submit="onSubmit"
        style="margin-bottom: 49px;" />

    <Nav></Nav>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { showToast } from 'vant';
import Nav from '../components/Nav.vue'
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
import 'vant/es/nav-bar/style'
import 'vant/es/tabs/style'
import 'vant/es/tab/style'

export default {
    components: {
        Nav,
    },
    setup() {
        const value = ref('');
        const checked = ref(false);
        const active = ref(0);
        const onClickTab = ({ title }) => {
            console.log("选中", title);
        };

        return {
            value,
            checked,
            active,
            onClickTab,
        };
    },
    data() {
        return {
            cart: [], // define cart as an empty array
            cartTotalPrice: 0,
            cartTotalQuantity: 0,
            dishes1: [],
            dishes2: [],
            dishes3: [],
            dishes4: [],
            dish_id: 0,
            user_id: 1,
            name: '',
            img: '',
            dish_flavor: 'default',
            amount: 0,
        };
    },
    methods: {
        getDishes1() {
            const id = 1; // replace with the correct category id
            axios.get(`http://localhost/resphp/getDish.php?id=${id}`).then(response => {
                if (response.data[0].code === 1) {
                    this.dishes1 = response.data[0].data;
                }
            });
        },
        getDishes2() {
            const id = 2; // replace with the correct category id
            axios.get(`http://localhost/resphp/getDish.php?id=${id}`).then(response => {
                if (response.data[0].code === 1) {
                    this.dishes2 = response.data[0].data;
                }
            });
        },
        getDishes3() {
            const id = 3; // replace with the correct category id
            axios.get(`http://localhost/resphp/getDish.php?id=${id}`).then(response => {
                if (response.data[0].code === 1) {
                    this.dishes3 = response.data[0].data;
                }
            });
        },
        getDishes4() {
            const id = 4; // replace with the correct category id
            axios.get(`http://localhost/resphp/getDish.php?id=${id}`).then(response => {
                if (response.data[0].code === 1) {
                    this.dishes4 = response.data[0].data;
                }
            });
        },
        addToCart(dish) {
            // convert dish price to number
            dish.dish_price = parseFloat(dish.dish_price);

            console.log(dish.dish_id, dish.dish_name, dish.dish_price, dish.dish_img, dish.dish_flavor, dish.amount);
            // add dish to cart
            this.cart.push(dish);
            this.cartTotalPrice += dish.dish_price;
            this.cartTotalQuantity++;

            // add dish to cart
            // this.cart.push({
            //     dish_id: dish.dish_id,
            //     user_id: this.user_id,
            //     name: dish.name,
            //     img: this.img,
            //     dish_flavor: this.dish_flavor,
            //     amount: this.amount,
            // });

            // save cart data to local storage
            localStorage.setItem('cart', JSON.stringify(this.cart));
            localStorage.setItem('cartTotalPrice', this.cartTotalPrice);
            localStorage.setItem('cartTotalQuantity', this.cartTotalQuantity);

            // 给数据库中的dish表中的dish_weight字段加1
            axios.get(`http://localhost/resphp/getDish.php?id=${dish.dish_id}`).then(response => {
                if (response.data[0].code === 1) {
                    // 给数据库中的dish表中的dish_weight字段加1
                    dish.dish_weight += 1;
                    console.log('add dish weight successfully');
                }
            });

            // send GET request
            axios.get(`http://localhost/resphp/addShopping.php`
                , {
                    params: {
                        dish_id: this.cart[0].dish_id,
                        user_id: this.user_id,
                        name: this.cart[0].dish_name,
                        img: this.cart[0].dish_img,
                        dish_flavor: "888",
                        amount: "999",
                    },
                })
                .then(response => {
                    // console.log(response.data);
                    console.log('add shopping successfully');
                    showToast('添加成功');
                })
                .catch(error => {
                    console.log(error);
                });

        },
        onSubmit() {
            // check if cart is empty, if yes, show alert and return, if no, route to State page
            if (this.cart.length === 0) {
                console.log('cart is empty');
                showToast('购物车为空');
                return;
            } else {

                // clear cart
                this.cart = [];
                this.cartTotalPrice = 0;
                this.cartTotalQuantity = 0;

                this.$router.push('/state');
            }
        },
    },
    mounted() {
        this.getDishes1();
        this.getDishes2();
        this.getDishes3();
        this.getDishes4();
    },
};
</script>