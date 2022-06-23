<?php


    include_once "db/db.php";

    //구독중인 사용자와 가게번호 가지고 오는 함수
    function sel_sub_num() {
        $conn = get_conn();
        $sql = "SELECT user_num, store_num
        FROM t_sub
        ORDER BY user_num";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function sel_reviwe_star(&$param) {
        $user_num = $param['user_num'];
        $store_num = $param['store_num'];
        $conn = get_conn();
        $sql = "SELECT star_rating
        FROM t_review
        WHERE user_num = $user_num AND store_num = $store_num";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if($result != null) {
            $row = mysqli_fetch_assoc($result);
            return $row['star_rating'];
        } 
        return 3;
        
    }

class Recommend {

    public function similarityDistance($preferences, $person1, $person2)
    {
        $similar = array();
        $sum = 0;
    
        //2차배열중 키가 확인하려는 사람의 상품과 리뷰를 분리한다.
        foreach($preferences[$person1] as $key=>$value)
        {
            //만약에 상품이 다른 사람의 상품에도 들어있다면
            if(array_key_exists($key, $preferences[$person2]))
                //유사배열에 1의 값을 추가해랴
                $similar[$key] = 1;
        }
        
        //만약 유사배열이 비었다면(중복되는 상품을 구매하지 않았다면)
        if(count($similar) == 0)
            //0을 리턴해라
            return 0;
        
        //2차배열중 키가 확인하려는 사람의 상품과 리뷰를 분리한다.
        foreach($preferences[$person1] as $key=>$value)
        {
            //만약에 상품이 다른 사람의 상품에도 들어있다면
            if(array_key_exists($key, $preferences[$person2]))
                //pow(수, 지수) : 제곱근함수
                //sum변수은 사람1의 리뷰값 빼기 사람2의 리뷰값을 빼고 그걸 제곱해서 다시 sum에 담아라
                $sum = $sum + pow($value - $preferences[$person2][$key], 2);
        }
        
        //합의 제곱근의 구하고 1을 더하여 그 값을 1과 나누어 리턴한다
        return  1/(1 + sqrt($sum));     
    }
    

    //가장 먼저 실행
    //$preferences : 내가 추천하려는 리스트가 2차 배열로 포함(키1:이름 => 남긴리뷰/키2:상품 => 별점)
    public function getRecommendations($preferences, $person)
    {
        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        
        //2차 배열을 1차 배열로 분리 하여 매개변수의 사람이름과 비교한다
        foreach($preferences as $otherPerson=>$values)
        {
            //만약에 확인하려는 이름과 다른 사람의 이름이라면
            if($otherPerson != $person)
            {
                //similarityDistance(2차배열, 확인하려는 사람이름, preferences꺼낸 이름)호출
                //similarityDistance함수는 유사성의 리턴한다
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);
            }
            
            //유사성이 0이 아니라면 
            if($sim > 0)
            {
                //확인하려는 사람의 이외의 사람의 상품과 리뷰만 가지고 온다
                foreach($preferences[$otherPerson] as $key=>$value)
                {
                    //만약 확인하려는 사람의 상품과 일치하는 상품이 없다면
                    if(!array_key_exists($key, $preferences[$person]))
                    {
                        //만약 확인하려는 사람의 상품이 total배열에 없다면
                        if(!array_key_exists($key, $total)) {
                            //total배열에 0을 추가한다
                            $total[$key] = 0;
                        }
                        //확인하려는 사람의 상품이 total배열에 있다면
                        //total배열에 키 값으로 확인하려는 사람이 아닌사람의 리뷰에 유사성값을 곱해서 값을 담는다.
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;
                        
                        //만약에 상품이 simSums에 포함되어있지 않다면
                        if(!array_key_exists($key, $simSums)) {
                            //simSums배열에 0을 담는다
                            $simSums[$key] = 0;
                        }
                        //포함되어있다면 simSum 배열에 유사값을 더한다
                        $simSums[$key] += $sim;
                    }
                }
                
            }
        }

        //두사람의 상품이 같은 리뷰의 값에 유사성이 있는 total배열을 분리
        foreach($total as $key=>$value)
        {
            //total의 값에서 유사값을 나눈 다음 ranks배열에 담는다
            //동일한 상품이 있는 사람중에 다른 상품의 별점을 계산해서 상품명과 리뷰값을 저장
            $ranks[$key] = $value / $simSums[$key];
        }
        
    //array_multisort — 다중 또는 다차원 배열 정렬
    //ranks배열의 내림차순정렬한다
    array_multisort($ranks, SORT_DESC);   
    //정렬한 ranks배열을 리턴한다 
    return $ranks;
        
    }
   
}

?>