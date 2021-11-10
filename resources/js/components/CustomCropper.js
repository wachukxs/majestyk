import Cropper from "react-cropper";
import "cropperjs/dist/cropper.css";
import React, { useRef, useState } from "react";

function CustomCropper() {

    const defaultSrc = "https://raw.githubusercontent.com/roadmanfong/react-cropper/master/example/img/child.jpg";
    const cropperRef = useRef(null);
    const [image, setImage] = useState(defaultSrc);
    const [cropData, setCropData] = useState(null);
    const [cropper, setCropper] = useState();

    const onCrop = () => {
        if (cropperRef) {
            const imageElement = cropperRef.current;
            const cropper = imageElement.cropper;
            console.log('onCrop: ', cropper.getCroppedCanvas().toDataURL());
        }
    };

    const getCropData = () => {
        console.log('cropping');
        if (typeof cropper !== "undefined") {
            console.log('cropped');
            setCropData(cropper.getCroppedCanvas().toDataURL());
        }
    };

    return (
        <>
        <Cropper
            src="https://raw.githubusercontent.com/roadmanfong/react-cropper/master/example/img/child.jpg"
            style={{ height: 400, width: "100%" }}
            // Cropper.js options
            initialAspectRatio={16 / 9}
            guides={false}
            crop={onCrop}
            ref={cropperRef}
            onInitialized={(instance) => {
                setCropper(instance);
            }}
            guides={true}
        />

        <button onClick={getCropData}>
            Crop Image
        </button>
        </>
    )
}
export default CustomCropper

// if (document.getElementById('the-cropper')) {
//     ReactDOM.render(<CustomCropper />, document.getElementById('the-cropper'));
// }