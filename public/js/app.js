window.addEventListener('toggleEvent',(event)=>{
    let data = event.detail
    console.log(data);
    Swal.fire({
        icon: data.type,
        title: data.title,
        text: data.text
      });
})