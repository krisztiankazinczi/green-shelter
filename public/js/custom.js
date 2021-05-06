const validateField = (value) => {
  if (!value) {
    return false;
  }
  return true;
}

const validateFields = (fields) => {
  const errors = [];
  fields.forEach((field) => {
    if (!field.field.value) {
      errors.push({ ...field, error: 'A mező értékét kötelező kitölteni' })
      return;
    } 
    if (field.rules?.min) {
      if (field.field.value.length < field.rules.min) {
        errors.push({ ...field, error: `A mezőbe minimum ${field.rules.min} karaktert kell írni` })
        return;
      }
    }
    if (field.rules?.max) {
      if (field.field.value.length > field.rules.max) {
        errors.push({ ...field, error: `A mezőbe maximum ${field.rules.max} karaktert lehet írni` })
        return;
      }
    }
    if (field.rules?.email) {
      const email_validator_regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      if (!email_validator_regex.test(field.field.value)) {
        errors.push({ ...field, error: `Érvényes email címet adj meg` })
        return;
      }
    }

  });
  return errors;
}

const clearFormErrors = (htmlInputFields) => {
  htmlInputFields.forEach(input => {
    const parent = input.parentElement;
    input.classList.remove('is-invalid');
    if (parent.childNodes[3]) {
      parent.removeChild(parent.childNodes[3]);    
    }
  });
}

// {
//   field: HTMLInputElement | HTMLTextAreaElement,
//   error: string,
//   type: 'small' | 'big'
// }[]
const createVisualErrors = (htmlInputFields) => {
  htmlInputFields.forEach(field => {
    field.field.classList.add('is-invalid');
    const node = document.createElement("SPAN");
    node.className = `invalid-feedback ${field.margin === 'big' ? 'ml-4' : 'ml-1'} subject-error`;                
    const textnode = document.createTextNode(field.error);         
    node.appendChild(textnode);                             
    field.field.parentElement.appendChild(node);
  })
}

const validateSendMessageForm = (event) => {
  event.preventDefault();
  const subject = document.getElementById('subject');
  const message = document.getElementById('message');
  clearFormErrors([subject, message]);

  const fields = [
    { field: subject, margin: 'big', rules: {'max': 150} },
    { field: message, margin: 'small', rules: {} }
  ];

  const errors = validateFields(fields);
  createVisualErrors(errors);

  if (errors.length) {
    return false;
  }

  const form = subject.parentElement.parentElement;
  form.submit();
}

const validateContactForm = (event) => {
  event.preventDefault();
  const subject = document.getElementById('subject');
  const name = document.getElementById('name');
  const email = document.getElementById('email');
  const message = document.getElementById('message');
  clearFormErrors([name, email, subject, message]);

  const fields = [
    { field: name, margin: 'small', rules: {'max': 255, 'min': 5} },
    { field: email, margin: 'small', rules: {'max': 255, 'min': 5, 'email': 'email'} },
    { field: subject, margin: 'small', rules: {'max': 255, 'min': 5} },
    { field: message, margin: 'small', rules: {} }
  ];

  const errors = validateFields(fields);
  createVisualErrors(errors);

  if (errors.length) {
    return false;
  }

  const form = subject.parentElement.parentElement.parentElement;
  form.submit();
}