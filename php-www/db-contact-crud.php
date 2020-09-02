<?php
// We will implement a typical Data CRUD (Create, Retrieve, Update and Delete) operations
// in PHP with ajax RESTful solution here.
// 
// This page will be the UI using VueJS+BulmaCSS. See "db-contact-crud-ajax.php" for backend logic.
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DB CRUD Example</title>
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma">
	<script type="text/javascript" src="https://unpkg.com/vue"></script>
</head>
<body>
	<div id="app">
		<section class="section">
            <button class="button is-primary" @click="create()">Create</button>
			<button class="button" @click="getAllRecords()">Refresh</button>
			<h1 class="title">List of Contacts</h1>
			<table class="table">
				<tr v-for="contact in contacts">
					<td>{{ contact.id }}</td>
					<td>{{ contact.create_date }}</td>
					<td>{{ contact.name }}</td>
					<td>
						<button class="button is-info" @click="getRecord(contact.id)">View</button>
						<button class="button is-danger" @click="deleteRecord(contact.id)">Delete</button>
					</td>
				</tr>
			</table>
		</section>
        <div id="createRecord">
            <div class="panel">
                <p class="panel-heading">
                    Create New Contact
                    <a class="delete is-pulled-right" @click="closeCreateRecord"></a>
                </p>
                <div class="panel-block">
                    <div>
                        <div class="field">
                            <div class="label">Name</div>
                            <div class="control"><input class="input" name="name"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
		<div id="viewRecord" v-if="viewRecord">
			<div class="panel">
			  <p class="panel-heading">
			    Contact Details
			    <a class="delete is-pulled-right" @click="closeViewRecord"></a>
			  </p>
			  <div class="panel-block">
				<table class="table">
					<tr>
						<td>ID</td>
						<td>{{ viewRecord.id }}</td>
					</tr>
					<tr>
						<td>Create Date</td>
						<td>{{ viewRecord.create_date }}</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>{{ viewRecord.name }}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{{ viewRecord.email }}</td>
					</tr>
					<tr>
						<td>Message</td>
						<td>{{ viewRecord.message }}</td>
					</tr>
				</table>
			  </div>
			</div>
		</div>
	</div>

	<script>
		new Vue({
			el: "#app",
			data: {
				contacts: [],
				viewRecord: null,
                createRecord: null
			},
			created: function () {
				this.getAllRecords();
			},
			methods: {
				getAllRecords: function() {
					fetch("db-contact-crud-ajax.php/contacts").then(resp => resp.json())
						.then(data => {
							console.log("Received " + data.length + " records.");
							this.contacts = data;
						});
				},
				deleteRecord: function(contactId) {
					const options = {
						method: "DELETE"
					};
					fetch(`db-contact-crud-ajax.php/contacts/${contactId}`, options).then(resp => resp.json())
						.then(data => {
							console.log("Deleted record " + contactId);
							this.contacts = this.contacts.filter(e => e.id !== contactId);
						});
				},
				getRecord: function(contactId) {
					fetch(`db-contact-crud-ajax.php/contacts/${contactId}`).then(resp => resp.json())
						.then(data => {
							console.log("Viewing record ", data);
							this.viewRecord = data;
						});
				},
				closeCreateRecord: function() {
					this.createRecord = null;
				},
                closeViewRecord: function() {
                    this.viewRecord = null;
                }
			}
		});
	</script>
</body>
</html>