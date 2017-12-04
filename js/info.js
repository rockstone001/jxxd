/**
 * Created by chai on 2016-7-28.
 */
var infos = {
    data: {
        "Nianzhu": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "辛",
                    "CangGanShiShen": "比肩"
                }
            ],
            "GanZhi": "辛酉",
            "ShiShen": "比肩",
            "WangShuai": "临官",
            "NaYin": "石榴木",
            "KongWang": "子丑",
            "ShenShaList": [
                "干禄",
                "红艳煞"
            ]
        },
        "Yuezhu": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "辛",
                    "CangGanShiShen": "比肩"
                }
            ],
            "GanZhi": "丁酉",
            "ShiShen": "七杀",
            "WangShuai": "临官",
            "NaYin": "山下火",
            "KongWang": "辰巳",
            "ShenShaList": [
                "干禄",
                "红艳煞"
            ]
        },
        "Rizhu": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "甲",
                    "CangGanShiShen": "正财"
                },
                {
                    "CangGan": "壬",
                    "CangGanShiShen": "伤官"
                }
            ],
            "GanZhi": "辛亥",
            "ShiShen": "",
            "WangShuai": "沐浴",
            "NaYin": "钗钏金",
            "KongWang": "寅卯",
            "ShenShaList": [
                "孤辰"
            ]
        },
        "Shizhu": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "己",
                    "CangGanShiShen": "偏印"
                },
                {
                    "CangGan": "丁",
                    "CangGanShiShen": "七杀"
                },
                {
                    "CangGan": "乙",
                    "CangGanShiShen": "偏财"
                }
            ],
            "GanZhi": "乙未",
            "ShiShen": "偏财",
            "WangShuai": "衰",
            "NaYin": "砂石金",
            "KongWang": "辰巳",
            "ShenShaList": [
                "寡宿",
                "华盖"
            ]
        },
        "Taiyuan": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "癸",
                    "CangGanShiShen": "食神"
                }
            ],
            "GanZhi": "戊子",
            "ShiShen": "正印",
            "WangShuai": "长生",
            "NaYin": "霹雳火",
            "KongWang": "",
            "ShenShaList": [
                "文昌贵人",
                "桃花"
            ]
        },
        "Minggong": {
            "DiZhiCangGanList": [
                {
                    "CangGan": "癸",
                    "CangGanShiShen": "食神"
                }
            ],
            "GanZhi": "庚子",
            "ShiShen": "劫财",
            "WangShuai": "长生",
            "NaYin": "壁上土",
            "KongWang": "",
            "ShenShaList": [
                "月德",
                "文昌贵人",
                "桃花"
            ]
        },
        "DayunList": [
            {
                "GanZhi": "戊戌",
                "ShiShen": "正印",
                "WangShuai": "冠带",
                "NaYin": "平地木"
            },
            {
                "GanZhi": "己亥",
                "ShiShen": "偏印",
                "WangShuai": "沐浴",
                "NaYin": "平地木"
            },
            {
                "GanZhi": "庚子",
                "ShiShen": "劫财",
                "WangShuai": "长生",
                "NaYin": "壁上土"
            },
            {
                "GanZhi": "辛丑",
                "ShiShen": "比肩",
                "WangShuai": "养",
                "NaYin": "壁上土"
            },
            {
                "GanZhi": "壬寅",
                "ShiShen": "伤官",
                "WangShuai": "胎",
                "NaYin": "金箔金"
            },
            {
                "GanZhi": "癸卯",
                "ShiShen": "食神",
                "WangShuai": "绝",
                "NaYin": "金箔金"
            },
            {
                "GanZhi": "甲辰",
                "ShiShen": "正财",
                "WangShuai": "墓",
                "NaYin": "灯头火"
            },
            {
                "GanZhi": "乙巳",
                "ShiShen": "偏财",
                "WangShuai": "死",
                "NaYin": "灯头火"
            }
        ],
        "LiunianList": [
            {
                "StartAge": 3,
                "StartYear": 1984,
                "ShiNianGanZhiArray": [
                    "甲子",
                    "乙丑",
                    "丙寅",
                    "丁卯",
                    "戊辰",
                    "己巳",
                    "庚午",
                    "辛未",
                    "壬申",
                    "癸酉"
                ]
            },
            {
                "StartAge": 13,
                "StartYear": 1994,
                "ShiNianGanZhiArray": [
                    "甲戌",
                    "乙亥",
                    "丙子",
                    "丁丑",
                    "戊寅",
                    "己卯",
                    "庚辰",
                    "辛巳",
                    "壬午",
                    "癸未"
                ]
            },
            {
                "StartAge": 23,
                "StartYear": 2004,
                "ShiNianGanZhiArray": [
                    "甲申",
                    "乙酉",
                    "丙戌",
                    "丁亥",
                    "戊子",
                    "己丑",
                    "庚寅",
                    "辛卯",
                    "壬辰",
                    "癸巳"
                ]
            },
            {
                "StartAge": 33,
                "StartYear": 2014,
                "ShiNianGanZhiArray": [
                    "甲午",
                    "乙未",
                    "丙申",
                    "丁酉",
                    "戊戌",
                    "己亥",
                    "庚子",
                    "辛丑",
                    "壬寅",
                    "癸卯"
                ]
            },
            {
                "StartAge": 43,
                "StartYear": 2024,
                "ShiNianGanZhiArray": [
                    "甲辰",
                    "乙巳",
                    "丙午",
                    "丁未",
                    "戊申",
                    "己酉",
                    "庚戌",
                    "辛亥",
                    "壬子",
                    "癸丑"
                ]
            },
            {
                "StartAge": 53,
                "StartYear": 2034,
                "ShiNianGanZhiArray": [
                    "甲寅",
                    "乙卯",
                    "丙辰",
                    "丁巳",
                    "戊午",
                    "己未",
                    "庚申",
                    "辛酉",
                    "壬戌",
                    "癸亥"
                ]
            },
            {
                "StartAge": 63,
                "StartYear": 2044,
                "ShiNianGanZhiArray": [
                    "甲子",
                    "乙丑",
                    "丙寅",
                    "丁卯",
                    "戊辰",
                    "己巳",
                    "庚午",
                    "辛未",
                    "壬申",
                    "癸酉"
                ]
            },
            {
                "StartAge": 73,
                "StartYear": 2054,
                "ShiNianGanZhiArray": [
                    "甲戌",
                    "乙亥",
                    "丙子",
                    "丁丑",
                    "戊寅",
                    "己卯",
                    "庚辰",
                    "辛巳",
                    "壬午",
                    "癸未"
                ]
            }
        ],
        "GongJiaAnDaiList": [
            {
                "SourceType": 1,
                "CalcType": 1,
                "CalcString": "辛酉",
                "RefString": "辛亥",
                "Value": "戌"
            },
            {
                "SourceType": 1,
                "CalcType": 2,
                "CalcString": "丁酉",
                "RefString": "乙未",
                "Value": "丙申"
            },
            {
                "SourceType": 2,
                "CalcType": 1,
                "CalcString": "戊戌",
                "RefString": "戊子",
                "Value": "亥"
            },
            {
                "SourceType": 2,
                "CalcType": 1,
                "CalcString": "辛丑",
                "RefString": "辛亥",
                "Value": "子"
            },
            {
                "SourceType": 2,
                "CalcType": 1,
                "CalcString": "乙巳",
                "RefString": "乙未",
                "Value": "午"
            },
            {
                "SourceType": 2,
                "CalcType": 2,
                "CalcString": "戊戌",
                "RefString": "庚子",
                "Value": "己亥"
            },
            {
                "SourceType": 2,
                "CalcType": 2,
                "CalcString": "己亥",
                "RefString": "丁酉",
                "Value": "戊戌"
            },
            {
                "SourceType": 2,
                "CalcType": 2,
                "CalcString": "壬寅",
                "RefString": "庚子",
                "Value": "辛丑"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛未",
                "RefString": "辛酉",
                "Value": "申"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛未",
                "RefString": "辛亥",
                "Value": "卯"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "乙亥",
                "RefString": "乙未",
                "Value": "卯"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "戊寅",
                "RefString": "戊子",
                "Value": "丑"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "乙酉",
                "RefString": "乙未",
                "Value": "申"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "丁亥",
                "RefString": "丁酉",
                "Value": "戌"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "庚寅",
                "RefString": "庚子",
                "Value": "丑"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "戊戌",
                "RefString": "戊子",
                "Value": "亥"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛丑",
                "RefString": "辛亥",
                "Value": "子"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "乙巳",
                "RefString": "乙未",
                "Value": "午"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "丁未",
                "RefString": "丁酉",
                "Value": "申"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "庚戌",
                "RefString": "庚子",
                "Value": "亥"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛亥",
                "RefString": "辛酉",
                "Value": "戌"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛酉",
                "RefString": "辛亥",
                "Value": "戌"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛未",
                "RefString": "辛酉",
                "Value": "申"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "辛未",
                "RefString": "辛亥",
                "Value": "卯"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "乙亥",
                "RefString": "乙未",
                "Value": "卯"
            },
            {
                "SourceType": 3,
                "CalcType": 1,
                "CalcString": "戊寅",
                "RefString": "戊子",
                "Value": "丑"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "丙戌",
                "RefString": "戊子",
                "Value": "丁亥"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "庚寅",
                "RefString": "戊子",
                "Value": "己丑"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "癸巳",
                "RefString": "乙未",
                "Value": "甲午"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "乙未",
                "RefString": "丁酉",
                "Value": "丙申"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "丁酉",
                "RefString": "乙未",
                "Value": "丙申"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "戊戌",
                "RefString": "庚子",
                "Value": "己亥"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "己亥",
                "RefString": "丁酉",
                "Value": "戊戌"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "壬寅",
                "RefString": "庚子",
                "Value": "辛丑"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "己酉",
                "RefString": "辛亥",
                "Value": "庚戌"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "癸丑",
                "RefString": "辛亥",
                "Value": "壬子"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "己未",
                "RefString": "辛酉",
                "Value": "庚申"
            },
            {
                "SourceType": 3,
                "CalcType": 2,
                "CalcString": "癸亥",
                "RefString": "辛酉",
                "Value": "壬戌"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "乙丑",
                "RefString": "乙巳",
                "Value": "酉"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "戊寅",
                "RefString": "戊戌",
                "Value": "午"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "辛巳",
                "RefString": "辛丑",
                "Value": "酉"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "甲申",
                "RefString": "甲辰",
                "Value": "子"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "戊子",
                "RefString": "戊戌",
                "Value": "亥"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "己丑",
                "RefString": "己亥",
                "Value": "子"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "庚寅",
                "RefString": "庚子",
                "Value": "丑"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "辛卯",
                "RefString": "辛丑",
                "Value": "寅"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "壬辰",
                "RefString": "壬寅",
                "Value": "卯"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "癸巳",
                "RefString": "癸卯",
                "Value": "辰"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "甲午",
                "RefString": "甲辰",
                "Value": "巳"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "乙未",
                "RefString": "乙巳",
                "Value": "午"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "戊申",
                "RefString": "戊戌",
                "Value": "酉"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "己酉",
                "RefString": "己亥",
                "Value": "戌"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "庚戌",
                "RefString": "庚子",
                "Value": "亥"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "辛亥",
                "RefString": "辛丑",
                "Value": "子"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "壬子",
                "RefString": "壬寅",
                "Value": "丑"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "癸丑",
                "RefString": "癸卯",
                "Value": "寅"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "甲寅",
                "RefString": "甲辰",
                "Value": "卯"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "乙卯",
                "RefString": "乙巳",
                "Value": "辰"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "己未",
                "RefString": "己亥",
                "Value": "卯"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "壬戌",
                "RefString": "壬寅",
                "Value": "午"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "乙丑",
                "RefString": "乙巳",
                "Value": "酉"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "戊寅",
                "RefString": "戊戌",
                "Value": "午"
            },
            {
                "SourceType": 4,
                "CalcType": 1,
                "CalcString": "辛巳",
                "RefString": "辛丑",
                "Value": "酉"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "丙申",
                "RefString": "戊戌",
                "Value": "丁酉"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "丁酉",
                "RefString": "己亥",
                "Value": "戊戌"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "戊戌",
                "RefString": "庚子",
                "Value": "己亥"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "己亥",
                "RefString": "辛丑",
                "Value": "庚子"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "庚子",
                "RefString": "戊戌",
                "Value": "己亥"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "庚子",
                "RefString": "壬寅",
                "Value": "辛丑"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "辛丑",
                "RefString": "己亥",
                "Value": "庚子"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "辛丑",
                "RefString": "癸卯",
                "Value": "壬寅"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "壬寅",
                "RefString": "庚子",
                "Value": "辛丑"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "壬寅",
                "RefString": "甲辰",
                "Value": "癸卯"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "癸卯",
                "RefString": "辛丑",
                "Value": "壬寅"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "癸卯",
                "RefString": "乙巳",
                "Value": "甲辰"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "甲辰",
                "RefString": "壬寅",
                "Value": "癸卯"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "乙巳",
                "RefString": "癸卯",
                "Value": "甲辰"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "丙午",
                "RefString": "甲辰",
                "Value": "乙巳"
            },
            {
                "SourceType": 4,
                "CalcType": 2,
                "CalcString": "丁未",
                "RefString": "乙巳",
                "Value": "丙午"
            }
        ]
    }
};