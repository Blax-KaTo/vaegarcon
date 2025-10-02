# EmailJS Integration Setup Guide

## Overview
This project uses EmailJS to send emails directly from the contact form and admin reply functionality. EmailJS allows sending emails from client-side JavaScript without exposing email credentials.

## Configuration Details
- **Service ID**: `service_eackrli`
- **Template ID**: `template_antaetp`
- **Public Key**: `9pDOJHmhrUQhpgEv8`

## EmailJS Template Setup

### 1. Contact Form Template Variables
The contact form sends the following variables to EmailJS:
- `from_name` - Sender's name
- `from_email` - Sender's email address
- `subject` - Email subject (defaults to "Contact Form Submission")
- `message` - The message content
- `to_email` - Recipient email (info@vaegarcon.com)
- `date` - Current date (formatted)
- `time` - Current time (formatted)

### 2. Admin Reply Template Variables
The admin reply functionality sends:
- `from_name` - "Vaegarcon Admin"
- `from_email` - "info@vaegarcon.com"
- `to_name` - Recipient's name
- `to_email` - Recipient's email address
- `subject` - Reply subject (prefixed with "Re: ")
- `message` - Reply message content
- `reply_to` - "info@vaegarcon.com"
- `date` - Current date (formatted)
- `time` - Current time (formatted)

## EmailJS Template Configuration

### Contact Form Template
Create a template in EmailJS with the following content:

**Subject**: `{{subject}}`

**Body**:
```
New contact form submission from {{from_name}}

Email: {{from_email}}
Subject: {{subject}}

Message:
{{message}}

---
This message was sent from the Vaegarcon contact form.
```

### Admin Reply Template
Create a template in EmailJS with the following content:

**Subject**: `{{subject}}`

**Body**:
```
Dear {{to_name}},

{{message}}

Best regards,
Vaegarcon Team

---
This is a reply to your contact form submission.
```

## Features Implemented

### Contact Form (Public)
- ✅ **Dual Submission**: Messages sent via EmailJS AND saved to database
- ✅ Real-time email sending via EmailJS
- ✅ Database storage for admin management
- ✅ Form validation and error handling
- ✅ Loading states and user feedback
- ✅ Graceful fallback if email fails
- ✅ Responsive design with animations

### Admin Contact Messages
- ✅ Reply modal with pre-filled recipient information
- ✅ Email sending via EmailJS from admin panel
- ✅ Status updates after sending replies
- ✅ Professional email templates
- ✅ Error handling and user feedback
- ✅ Mobile-responsive modal design

### Admin Individual Message View
- ✅ Reply functionality with modal
- ✅ Automatic status updates
- ✅ Professional email composition
- ✅ Error handling and success feedback

## Testing the Integration

### 1. Test Contact Form
1. Go to the contact page
2. Fill out the form with test data
3. Submit the form
4. Check that:
   - Email is sent successfully via EmailJS
   - Success message appears
   - Message is saved to database
   - Admin can see the message in contact messages
5. Test with EmailJS disabled to ensure database storage still works

### 2. Test Admin Reply
1. Go to admin contact messages
2. Click "Reply" on any message
3. Fill out the reply form
4. Send the reply
5. Check that:
   - Email is sent successfully
   - Success message appears
   - Modal closes
   - Message status updates to "replied"

## Troubleshooting

### Common Issues
1. **EmailJS not initialized**: Check that the public key is correct
2. **Template not found**: Verify template ID matches the one in code
3. **Service not found**: Verify service ID is correct
4. **CORS errors**: Ensure EmailJS service is properly configured

### Debug Mode
Open browser console to see detailed logs:
- EmailJS initialization status
- Email sending success/error messages
- Form submission details

## Security Notes
- EmailJS public key is safe to expose in client-side code
- No sensitive credentials are stored in the frontend
- All email sending is handled through EmailJS's secure service
- Database storage provides backup for all contact messages

## Customization
To modify email templates or add new functionality:
1. Update the EmailJS template in the EmailJS dashboard
2. Modify the `templateParams` object in the JavaScript code
3. Test thoroughly before deploying changes
