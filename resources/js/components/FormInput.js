import { useState } from "react"
import ReactDOM from 'react-dom';

function FormInput(props) {
    const [uploadMethod, setUploadMethod] = useState('original') // initialize to first option ?

    const [selectedFile, setSelectedFile] = useState(null);

    const handleSelectUploadChange = (evt) => {
        setUploadMethod(evt.nativeEvent.target.value)
        // console.log('uploadMethod', uploadMethod); // uploadMethod isn't updating accurately // bug ??
    }

    const handleFileUploadChange = (evt) => {

        if (evt.target.files.length) {
            createImage(evt.target.files[0]);
        }
        
        console.log('evt.nativeEvent.target', evt.target.files.length);
    }

    const submitForm = () => {
        console.log('submit');

        axios.post('http://localhost:8000/uploads', {
            imagefile: selectedFile,
            imagetext: uploadMethod
        })
        .then(response => {
            console.log('submitted', response)
        }).catch((err) => {
            console.log(err);
            console.error('post err', err);
        })
    };

    const createImage = (file) => {
        let reader = new FileReader();
        reader.onload = (e) => {
            //   this.setState({
            //     image: e.target.result
            //   })
            console.log('converted the pic');
            setSelectedFile(e.target.result)
        };
        reader.readAsDataURL(file);
    }

    return (
        <div>
            <label htmlFor="upload-select">Choose upload method:</label>

            <select name="upload-method" id="upload-select" onChange={handleSelectUploadChange}>
                <option value="original">Original</option>
                <option value="square">Square</option>
                <option value="small">Small</option>
                <option value="all">All Three</option>
            </select>

            <br/>
            <input type="file" onChange={handleFileUploadChange} />

            <br/>

            <button onClick={submitForm}>Submit</button>
        </div>
    )
}

export default FormInput

if (document.getElementById('the-form')) {
    ReactDOM.render(<FormInput />, document.getElementById('the-form'));
}