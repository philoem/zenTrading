class Toggle {

    constructor() {
        this.element = document.getElementById('sidebar')
        this.event()

    }
    event() {
        document.querySelector('.toggle').addEventListener('click', () => {
            console.log('TEST')
            this.toggle()
        })
    }

    toggle() {
        this.element.classList.toggle('active')
        
    }
    
    
}
const toggle = new Toggle();