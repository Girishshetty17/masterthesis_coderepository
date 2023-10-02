from locust import HttpUser, task, between


class MyUser(HttpUser):
    wait_time = between(1, 3)

    @task
    def submit_form(self):
        headers = {'Content-Type': 'application/x-www-form-urlencoded'}
        data = {
            'name': 'John Doe',
            'email': 'john.doe@example.com',
            'subject': 'Test Subject',
            'message': 'This is a test message.'
        }
        response = self.client.post('/default.php', data=data, headers=headers)
        if response.status_code == 200:
            print("Form submitted successfully!")
        else:
            print("Form submission failed.")

    @task
    def view_success_page(self):
        self.client.get('/success.html')
