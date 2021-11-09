import React from 'react';
import ReactDOM from 'react-dom';

function Hey() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Welcome</div>

                        <div className="card-body">Login or register to continue!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Hey;

if (document.getElementById('hey')) {
    ReactDOM.render(<Hey />, document.getElementById('hey'));
}
