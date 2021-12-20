let mode = "development";
// let mode = "production";

export default{
    api_url: function(){
        return (mode == "development")? 
            "http://localhost:8080" :
            "http://localhost:5000";
    }
}