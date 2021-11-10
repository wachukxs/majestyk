import { useState } from "react"
import ReactDOM from 'react-dom';
import CustomCropper from './CustomCropper';

function FormInput(props) {
    const [uploadMethod, setUploadMethod] = useState('original')

    const [selectedFile, setSelectedFile] = useState([]);

    const handleSelectUploadChange = (evt) => {
        console.log('setting upload value', evt.nativeEvent.target.value);
        setUploadMethod(evt.nativeEvent.target.value);
        // console.log('uploadMethod', uploadMethod); // uploadMethod isn't updating accurately // bug ??
    }

    const handleFileUploadChange = (evt) => {

        evt.preventDefault();

        let files;
        if (evt.dataTransfer) {
            files = evt.dataTransfer.files;
        } else if (evt.target) {
            files = evt.target.files;
        }

        if (evt.target.files.length) {
            createImage(evt.target.files[0]);
        }

        console.log('evt.nativeEvent.target', evt.target.files.length);
        // reset drop down to original
        setUploadMethod('original')
    }


    const submitForm = () => {
        console.log('submit');

        axios.post('http://localhost:8000/uploads', {
            imagefile: selectedFile,
            imagetext: uploadMethod
        }).then(response => {
            console.log('submitted', response)
        }).catch((err) => {
            console.log(err);
            console.error('post err', err);
        })
    };

    const createImage = (file) => {
        let reader = new FileReader();
        reader.onload = (e) => {
            console.log('converted the pic');
            setSelectedFile([e.target.result])
        };
        reader.readAsDataURL(file);
    }

    return (
        <div>
            <label htmlFor="upload-select">Choose upload method:</label>

            <select className="form-control" name="upload-method" id="upload-select" onChange={handleSelectUploadChange} value={uploadMethod}>
                <option value="original">Original</option>
                <option value="square">Square</option>
                <option value="small">Small</option>
                <option value="all">All Three</option>
            </select>

            <br />
            <input type="file" accept="image/x-png,image/jpeg" onChange={handleFileUploadChange} />

            <br />
                {/* https://stackoverflow.com/a/66442653/9259701 */}
                <CustomCropper imgIn={selectedFile} imageSize={uploadMethod} updateImg={setSelectedFile} />
            <br />

            <button className="btn btn-primary" onClick={submitForm}>Submit</button>
        </div>
    )
}

export default FormInput

if (document.getElementById('the-form')) {
    ReactDOM.render(<FormInput />, document.getElementById('the-form'));
}