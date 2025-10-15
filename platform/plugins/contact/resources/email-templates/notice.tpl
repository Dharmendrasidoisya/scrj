{{ header }}

<div class="email-container">
    <div class="email-header">New Inquiry</div>

    <table class="email-table">
        <tr>
            <th>Name</th>
            <td>{{ contact_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
               {% if contact_email %}
            <td>{{ contact_email }}</td>
               {% endif %}
        </tr>
        <tr>
            <th>Phone</th>
               {% if contact_phone %}
            <td> {{ contact_phone }}</td>
                {% endif %}
        </tr>
        <tr>
            <th>Location</th>
               {% if contact_address %}
            <td>{{ contact_address }}</td>
              {% endif %}
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ contact_content }}</td>
        </tr>
    </table>

</div>

{{ footer }}
