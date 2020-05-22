<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <!-- Search form -->
                        <div class="md-form mt-0">
                            <i
                                class="fa fa-search position-absolute"
                                style="margin-top: 10px;margin-left: 10px"
                            ></i>
                            <input
                                v-model="Search"
                                v-on:keyup.enter="bookSearch()"
                                class="form-control"
                                style="text-indent: 20px"
                                type="text"
                                placeholder="Search by name or author"
                                aria-label="Search"
                            />
                        </div>
                    </div>
                    <div
                        class="col-md-6 d-flex justify-content-center align-items-center"
                    >
                        <div class="mr-3">Order By:</div>
                        <div class="btn-group btn-group-toggle">
                            <label
                                class="btn btn-secondary"
                                :class="{ active: orderActive === 'rate' }"
                            >
                                <input
                                    v-on:change="bookSearch()"
                                    type="radio"
                                    value="rate"
                                    v-model="orderActive"
                                    name="options"
                                    id="option1"
                                />
                                Rate
                            </label>
                            <label
                                class="btn btn-secondary"
                                :class="{ active: orderActive === 'latest' }"
                            >
                                <input
                                    v-on:change="bookSearch()"
                                    type="radio"
                                    value="latest"
                                    v-model="orderActive"
                                    name="options"
                                    id="option2"
                                />
                                Latest
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="list-group">
                    <input
                        @change="bookSearch()"
                        v-model="categoryID"
                        type="radio"
                        name="RadioInputName"
                        value="0"
                        id="All"
                    />
                    <label class="list-group-item" for="All">All</label>
                    <template v-for="category in booksData.categories" >
                        <input
                            @change="bookSearch()"
                            v-model="categoryID"
                            type="radio"
                            name="RadioInputName"
                            :value="category.id"
                            :id="category.name"
                            :key="category.id"
                        />
                        <label class="list-group-item" :key="category.id" :for="category.name">{{
                            category.name
                        }}</label>
                    </template>
                </div>
            </div>
            <div class="col-md-8 position-relative overflow-auto">
                <div class="loadSearch" v-if="load">
                    <i class="fa fa-spinner fa-pulse"></i>
                </div>
                <div
                    v-if="checkBooks"
                    class="alert alert-secondary text-center"
                    role="alert"
                >
                    There is No Books Click
                    <a href="#" class="alert-link">Here</a> to add some books if
                    you like.
                </div>
                <div class="card-columns">
                    <div v-for="book in books" :key="book.id">
                        <div class="card">
                            <a v-bind:href="'/book/' + book.id">
                                <img
                                    :src="'/upload/' + book.image"
                                    class="card-img-top"
                                    alt="..."
                                />
                            </a>
                            <div class="card-body">
                                <div class="rateBook mb-2">
                                    <i
                                        v-for="(rate,index) in Math.floor(book.rate)" :key="index"
                                        class="fa fa-star"
                                    ></i>
                                    <i
                                        v-if="!Number.isInteger(book.rate)"
                                        class="fa fa-star-half-empty"
                                    ></i>
                                    <i
                                        v-for="(rate,index) in Number.isInteger(
                                            book.rate
                                        ) 
                                            ? 5 - Math.floor(book.rate)
                                            : 5 - Math.floor(book.rate + 1)"
                                        class="fa fa-star-o" :key="index"
                                    ></i>
                                </div>
                                <a v-bind:href="'/book/' + book.id">
                                    <h5 class="card-title">
                                        {{ book.bookName }}
                                    </h5>
                                </a>
                                <p class="card-text">{{ book.description }}</p>
                                <div
                                    class="d-flex justify-content-between align-items-center likeBook"
                                >
                                    <p
                                        v-if="book.count > 0"
                                        class="card-text mb-0"
                                    >
                                        <small class="text-muted"
                                            ><span>{{ book.count }}</span>
                                            copies available</small
                                        >
                                    </p>
                                    <p v-else class="card-text mb-0">
                                        <small class="text-muted"
                                            ><span
                                                class="badge badge-pill badge-danger"
                                                >Not Available</span
                                            ></small
                                        >
                                    </p>
                                    <i
                                        v-on:click="makeLike(book.id)"
                                        v-if="checkLike(book.id)"
                                        class="fa fa-heart text-danger"
                                    ></i>
                                    <i
                                        v-on:click="makeLike(book.id)"
                                        v-else
                                        class="fa fa-heart-o text-danger"
                                    ></i>
                                </div>
                            </div>
                            <button
                                class="btn btn-primary w-100"
                                :disabled="book.count === 0"
                            >
                                Lease
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    v-if="!checkBooks"
                    class="w-100 mt-2 d-flex justify-content-center"
                >
                    <pagination
                        v-if="booksData.books !== []"
                        :data="booksData.books"
                        :showDisabled="true"
                        @pagination-change-page="getResults"
                    >
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "IndexComponent",
    props: ["user_id"],
    data() {
        return {
            booksData: ["books", "userFavourites"],
            books: [],
            Search: "",
            load: false,
            orderActive: "rate",
            categoryID: "0",
            book_id: "",
            checkBooks: false
        };
    },

    methods: {
        getBooks: function() {
            this.books = [];
            axios
                .get(
                    "/api/home?user_id=" +
                        this.user_id +
                        "&search=" +
                        this.Search +
                        "&order=" +
                        this.orderActive +
                        "&category=" +
                        this.categoryID
                )
                .then(response => {
                    console.log(response.data);
                    this.booksData = response.data;
                    this.books = response.data.books.data;
                    this.checkBooks = this.books.length === 0;
                })
                .catch(error => {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
        },
        checkLike: function(id) {
            // console.log(this.books.userFavourites.includes(id));
            return !!this.booksData.userFavourites.includes(id);
        },
        bookSearch: function() {
            this.load = true;
            axios
                .get(
                    "/api/search/?user_id=" +
                        this.user_id +
                        "&search=" +
                        this.Search +
                        "&order=" +
                        this.orderActive +
                        "&category=" +
                        this.categoryID
                )
                .then(response => {
                    // console.log(response);

                    this.booksData = response.data;
                    this.books = response.data.books.data;
                    this.checkBooks = this.books.length === 0;
                    this.load = false;
                })
                .catch(error => {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
        },
        makeLike: function(id) {
            this.book_id = id;
            this.load = true;
            axios
                .post("/api/makeLike", {
                    book_id: this.book_id,
                    user_id: this.user_id
                })
                .then(response => {
                    console.log(response.data);
                    if (this.booksData.userFavourites.includes(id)) {
                        const index = this.booksData.userFavourites.indexOf(id);
                        if (index > -1) {
                            this.booksData.userFavourites.splice(index, 1);
                        }
                        // this.booksData.userFavourites.slice(id,1)
                    } else {
                        this.booksData.userFavourites.push(id);
                    }
                    this.checkBooks = this.books.length === 0;
                    // this.booksData = response.data;
                    // this.books = response.data.books.data;
                    this.load = false;
                })
                .catch(error => {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
        },
        getResults(page = 1) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get(
                    "/api/search?page=" +
                        page +
                        "&user_id=" +
                        this.user_id +
                        +"&search=" +
                        this.Search +
                        "&order=" +
                        this.orderActive +
                        "&category=" +
                        this.categoryID
                )
                .then(response => {
                    console.log(response.data);
                    this.booksData = response.data;
                    this.books = response.data.books.data;
                    this.checkBooks = this.books.length === 0;
                })
                .catch(error => {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
        }
    },
    mounted() {
        // console.log("mounted");
        // this.getBooks();
    },
    created() {
        // console.log("created");
        this.getBooks();
    }
};
</script>

<style scoped>
.loadSearch {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;
    opacity: 80%;
    min-height: 100%;
}
.loadSearch i {
    z-index: 99999;
    color: black;
    font-size: 60px;
}
</style>
