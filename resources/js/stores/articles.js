import { defineStore } from 'pinia';
import axios from 'axios';

export const useArticlesStore = defineStore('articles', {
    state: () => ({
        articles: [],
        searchQuery: 'tesla',
        page: 1,
        totalPages: 1,
        pageSize: 10,
        sortKey: '',
        sortOrders: {
            title: 'asc',
            'source.name': 'asc',
            publishedAt: 'asc',
            author: 'asc',
        },
        sortBy: 'relevancy', // Default sort by value

    }),
    getters: {
        filteredArticles: (state) => {
            return state.articles;
        },
    },
    actions: {
        async fetchArticles() {

            const response = await axios.get('/api/articles', {
                params: {
                    q: this.searchQuery,
                    page: this.page,
                    pageSize: this.pageSize,
                    sortBy: this.sortBy,
                },
            });
            this.articles = response.data.articles;
            this.totalPages = Math.ceil(response.data.totalResults / this.pageSize);
        },
        sort(key) {
            if (this.sortKey === key) {
                this.sortOrders[key] = this.sortOrders[key] === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortKey = key;
                this.sortOrders[key] = 'asc';
            }
            this.fetchArticles();
        },
        clearFilters() {
            this.searchQuery = 'tesla';
            this.fetchArticles();
        },
        handlePageChange(newPage) {
            this.page = newPage;
            this.fetchArticles();
        },
        updateSearchQuery(query) {
            this.searchQuery = query;
        },
        updateSortBy(sortBy) {
            this.sortBy = sortBy;
            this.fetchArticles();
        }

    },
});