<form 
  method="POST" 
  id="form" 
  enctype="multipart/form-data" 
  action="{{ route('send.message') }}"
>
  @csrf
  <div class="form-group row d-flex justify-content-center">
    <input style="width: 95%;" id="subject" placeholder="Tárgy" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" autofocus>
      @error('subject')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
  </div>
  <div class="form-group">
    <input type="hidden" name="from_id" value="{{ $from_id }}" />
    <input type="hidden" name="to_id" value="{{ $to_id }}" />
    <input type="hidden" name="animal_id" value="{{ $animal_id }}" />

    <div style="@error('message') border: 1px solid red; @enderror">
      <textarea placeholder="Üzenet" id="message" rows="6" class="form-control" name="message">{{ old('message') }}</textarea>
    </div>
    <div>
      @error('message')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
    <div class="form-group mb-0">
      <div class="d-flex justify-content-between">
          <a class="card-link text-danger" style="cursor: pointer;" onclick="{{ $cbFunction }}" >Mégse</a>
          <button type="submit" class="btn btn-primary btn-sm d-block" onclick="validateForm(event)">
              {{ __('Küldés') }}
          </button>
      </div>
    </div>
  </form>
</form>

<script>
  const validateForm = (event) => {
    event.preventDefault();
    const subject = document.getElementById('subject');
    const message = document.getElementById('message');
    const subjectParent = subject.parentElement;
    const messageParent = message.parentElement;
    subject.classList.remove('is-invalid');
    message.classList.remove('is-invalid');
    if (subjectParent.childNodes[3]) {
      subjectParent.removeChild(subjectParent.childNodes[3]);    
    }
    if (messageParent.childNodes[3]) {
      messageParent.removeChild(messageParent.childNodes[3]);    
    }


    if (!subject.value) {
      subject.classList.add('is-invalid');
      const node = document.createElement("SPAN");
      node.className = 'invalid-feedback ml-4 subject-error';                
      const textnode = document.createTextNode("A mező értékét kötelező kitölteni");         
      node.appendChild(textnode);                             
      subjectParent.appendChild(node);
    }

    if (!message.value) {
      message.classList.add('is-invalid');
      const node = document.createElement("SPAN");
      node.className = 'invalid-feedback ml-1 subject-error';                
      const textnode = document.createTextNode("A mező értékét kötelező kitölteni");         
      node.appendChild(textnode);                             
      messageParent.appendChild(node);
    }

    if (!subject.value || !message.value) {
      return false;
    }

    const form = subjectParent.parentElement;
    form.submit();
  }
</script>