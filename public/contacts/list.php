<?php require 'header.php' ?>
<div id="app" class="section">
    <h1 class="title">Contacts</h1>
    <p>Total Items: {{totalItems}}</p>
    <nav v-if="totalPages >= 2" class="pagination" role="navigation" aria-label="pagination">
        <a class="pagination-previous"
           @click="fetchPrevious" :disabled="(offset === 0) ? 'true' : undefined">Previous</a>
        <a class="pagination-next"
           @click="fetchNext" :disabled="hasMore ? undefined: 'true'">Next page</a>
        <ul class="pagination-list">
            <li v-for="p in displayPages">
                <span v-if="p === -1" class="pagination-ellipsis">&hellip;</span>
                <a v-else class="pagination-link"
                   :class="{'is-current': page === p}" @click="fetchPage(p)">{{p}}</a>
            </li>
        </ul>
    </nav>
    <table class="table is-fullwidth">
        <tr v-for="contact in contacts">
            <td>{{contact.id}}</td>
            <td>{{contact.create_ts}}</td>
            <td>{{contact.name}}</td>
            <td>{{contact.email}}</td>
            <td>{{contact.subject}}</td>
        </tr>
    </table>
</div>
<script>
    let vm = Vue.createApp({
        data: function () {
            return {
                contacts: [],
                totalItems: 0,
                pageSize: 5,
                hasMore: true,
                page: 1,
                offset: 0,
                numOfPageButtons: 5 // should be a odd number
            }
        },
        computed: {
            totalPages: function () {
                let ret = Math.floor(this.totalItems / this.pageSize);
                if (this.totalItems % this.pageSize === 0)
                    return ret;
                return ret + 1;
            },
            displayPages: function() {
                // We will use "-1" as page number for Ellipse.
                let ret = [];
                let half = Math.floor((this.numOfPageButtons - 1) / 2);

                // Only return pages if there are more than 2
                if (this.totalPages < 2)
                    return ret;

                // Ellipse and first page
                if ((this.page - half) > 1) {
                    ret.push(1);
                    if (this.page - half > 2) // Prevent ellipse on edge case
                        ret.push(-1);
                }

                // Pages before the current page
                for (let i = half; i > 0 ; i--) {
                    let p = this.page - i;
                    if (p > 0)
                        ret.push(p);
                }

                // current page
                ret.push(this.page);

                // Pages after the current page
                for (let i = 1; i <= half ; i++) {
                    let p = this.page + i;
                    if (p <= this.totalPages)
                        ret.push(p);
                }

                // Ellipse and last page
                if (ret[ret.length - 1] < this.totalPages) {
                    if (this.page + half < this.totalPages - 1) // Prevent ellipse on edge case
                        ret.push(-1);
                    ret.push(this.totalPages);
                }
                return ret;
            }
        },
        methods: {
            fetchData: function () {
                let url = `api.php?offset=${this.offset}&limit=${this.pageSize}`;
                fetch(url).then(resp => resp.json()).then(data => {
                    this.contacts = data.items;
                    this.totalItems = data.total_items;
                    this.hasMore = data.has_more;
                });
            },
            fetchNext() {
                if (this.hasMore) {
                    this.page++;
                    this.offset = this.offset + this.pageSize;
                    this.fetchData();
                }
            },
            fetchPrevious() {
                if (this.offset > 0) {
                    this.page--;
                    this.offset = this.offset - this.pageSize;
                    this.fetchData();
                }
            },
            fetchPage(pageNum) {
                if (pageNum <= this.totalPages) {
                    this.page = pageNum;
                    this.offset = (pageNum - 1) * this.pageSize;
                    this.fetchData();
                }
            }
        },
        mounted: function() {
            this.fetchData(0);
        }
    }).mount('#app');
</script>
<?php require 'footer.php' ?>

