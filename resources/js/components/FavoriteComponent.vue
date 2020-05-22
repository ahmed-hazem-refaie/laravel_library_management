<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="loadSearch" v-if="load">
                    <i class="fa fa-spinner fa-pulse"></i>
                </div>
                <div class="card-columns">
                    <div v-for="book in booksData" :key="book.id">
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
                                        class="fa fa-star-o"
                                        :key="index"
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
                                        class="fa fa-heart text-danger"
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
                    v-if="checkBooks"
                    class="alert alert-secondary text-center"
                    role="alert"
                >
                    There is No Book Favourites Click
                    <a href="/home" class="alert-link">Here</a> to add some
                    books favourites if you like.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "FavoriteComponent",
    props: ["user_id"],
    data() {
        return {
            booksData: [],
            load: false,
            book_id: "",
            checkBooks: false
        };
    },
    methods: {
        getBooks: function() {
            this.books = [];
            axios
                .get("/api/userFavorites?user_id=" + this.user_id)
                .then(response => {
                    console.log(response.data);
                    this.booksData = response.data.books;
                    this.checkBooks = this.booksData.length === 0;
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
                .post("/api/makeLikeFavourite", {
                    book_id: this.book_id,
                    user_id: this.user_id
                })
                .then(response => {
                    console.log(response.data);
                    this.booksData = response.data.books;
                    this.checkBooks = this.booksData.length === 0;
                    this.load = false;
                })
                .catch(error => {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
        }
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
