import React,{Fragment,useState,useEffect} from 'react'; //追加
import ReactDOM from 'react-dom';
import axios from 'axios'; //追加
 
function Example(){
    const [year,setYear] = useState(new Date().getFullYear())
    const [month,setMonth] = useState(new Date().getMonth()+1)
    const last = new Date(year,month,0).getDate() //追加
    const prevlast = new Date(year,month-1,0).getDate() //追加
    const calendar = createCalendear(year,month)
 
    const onClick = n => () => {
        const nextMonth = month + n
        if (12 < nextMonth) {
          setMonth(1)
          setYear(year + 1)
        } else if (nextMonth < 1) {
          setMonth(12)
          setYear(year - 1)
        } else {
          setMonth(nextMonth)
        }
    }

    //スケジュールのデータ
    const [schedules,setSche] = useState([])
 
    //画面読み込み時に、1度だけ起動
    useEffect(()=>{
        getPostData();
    },[])
 
    //バックエンドからデータ一覧を取得
    const getPostData = () =>{
        axios
        .post('/api/posts')
        .then(response=>{
            setSche(response.data); //バックエンドからのデータをセット
            console.log(response.data);
        }).catch(()=>{
            console.log('通信に失敗しました');
        });
    }
 
    //データ格納の空配列を作成
    let rows = [];
 
    //スケジュールデータをrowに格納する
    schedules.map((post)=>
        rows.push({
            sch_id:post.id,
            sch_category:post.sch_category,
            sch_contents:post.sch_contents,
            sch_date:post.sch_date,
            sch_time:post.sch_time
        })
    );

    return (
        <Fragment>
            <div className="calender-header">
                <h1>{`${year}年${month}月`}</h1>
                <div className="calender-nav">
                    <button onClick={onClick(-1)}>{'<先月'}</button>
                    <button onClick={onClick(1)}>{'翌月>'}</button>
                </div>
            </div>
            <table className="calender-table">
                <thead>
                    <tr>
                        <th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
                    </tr>
                </thead>
                <tbody>
                    {calendar.map((week,i) => (
                        <tr key={week.join('')}>
                            {week.map((day,j) => (
                                <td key={`${i}${j}`} id={day} >
                                    <div>
                                        <div>
                                            {day > last ? day - last : day <= 0 ? prevlast + day : day}
                                        </div>
                                        <div className="schedule-area">
                                            {rows.map((schedule,k) => (
                                                schedule.sch_date == year + '-' + zeroPadding(month) + '-' + zeroPadding(day) &&
                                                <div className='schedule-title' key={k} id={schedule.sch_id}>{schedule.sch_contents}</div>
                                                ))}
                                        </div>
                                    </div>
                                </td>
                            ))}
                        </tr>
                    ))}
                </tbody>
            </table>
        </Fragment>
    );
}
 
function createCalendear(year,month){
    const first = new Date(year,month - 1,1).getDay()
 
    return [0,1,2,3,4,5].map((weekIndex) => {
        return [0,1,2,3,4,5,6].map((dayIndex) => {
            const day = dayIndex + 1 + weekIndex * 7
            return day - first 
        })
    })
}


function zeroPadding(num){
    return ('0' + num).slice(-2);
}

export default Example;
 
if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}