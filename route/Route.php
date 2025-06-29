<?php 
    namespace Route;
    use AltoRouter as Router;
    class Route
    {
        private static $router;

        public static function get(string $path, callable $callback){
            self::getRouter()->map('GET', $path, $callback);
        }
        public static function post(string $path, callable $callback){
            self::getRouter()->map('POST', $path, $callback);
        }
        public static function put(string $path, callable $callback){
            static::getRouter()->map('PUT', $path, $callback);
        }
        public static function delete(string $path, callable $callback){
            self::getRouter()->map('DELETE', $path, $callback);
        }   

        
        public static function getRouter(){
            if(static::$router === null){
                static::$router = new Router();
            }
            return static::$router;
        }
        
        public static function origine(string $path){
            static::getRouter()->setBasePath($path);
        }

        public static function matcher(){
            $match = static::getRouter()->match();
            if($match){
                if(is_callable($match['target'])){
                    call_user_func($match['target'], $match['params']);
                }
            }else{
                echo "404";
            }
        }
    }

?>