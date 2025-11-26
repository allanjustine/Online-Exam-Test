<template>
    <div class="main-questions" style="margin: 2% 5% 0 5%">
        <div
            class="myQuestion"
            v-bind:id="'que' + index"
            v-for="(question, index) in questions"
            :key="index + uuid"
            v-show="count === index + 1"
        >
            <div class="row">
                <form
                    class="myForm"
                    action="/quiz_start"
                    v-on:submit.prevent="
                        createQuestion(question.question_id, question.index)
                    "
                    method="post"
                >
                    <input
                        type="hidden"
                        name="queIndex"
                        class="form-control queIndx"
                        v-bind:value="index + 1"
                    />
                    <div class="row" v-if="set > 1">
                        <h3 style="color: white" v-html="question.set"></h3>
                    </div>
                    <div class="col-md-5 bg-white" style="margin-top: 2%">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 style="font-weight: 700; font-size: 1.5rem">
                                    Question: &nbsp;&nbsp;{{ index + 1 }}
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <h5
                                    style="
                                        font-weight: 700;
                                        font-size: 1.5rem;
                                        text-align: center;
                                    "
                                >
                                    Single Choice Type Question
                                </h5>
                            </div>
                        </div>
                        <hr />
                        <div class="q-block">
                            <div v-if="slug == 'english'">
                                <p
                                    v-if="index + 1 <= 5"
                                    style="
                                        font-size: 1.2rem;
                                        color: gray;
                                        margin-bottom: 30px;
                                    "
                                >
                                    Choose the letter that best represents your
                                    answer.
                                </p>
                                <p
                                    v-if="index + 1 > 5 && index + 1 <= 10"
                                    style="
                                        font-size: 1.2rem;
                                        color: gray;
                                        margin-bottom: 30px;
                                    "
                                >
                                    For nos. 6-10, choose the correct
                                    alternative of the given analogous pair.
                                </p>
                                <p
                                    v-if="index + 1 > 10 && index + 1 <= 15"
                                    style="
                                        font-size: 1.2rem;
                                        color: gray;
                                        margin-bottom: 30px;
                                    "
                                >
                                    For nos. 11-15, choose the synonym or the
                                    meaning of the underlined words.
                                </p>
                                <p
                                    v-if="index + 1 > 15 && index + 1 <= 20"
                                    style="
                                        font-size: 1.2rem;
                                        color: gray;
                                        margin-bottom: 30px;
                                    "
                                >
                                    For nos. 16-20, choose the word/s that
                                    make/s the sentence incorrect.
                                </p>
                            </div>
                            <p
                                v-if="slug != 'english'"
                                style="
                                    font-size: 1.2rem;
                                    color: gray;
                                    margin-bottom: 30px;
                                "
                            >
                                Choose the letter that best represents your
                                answer.
                            </p>
                            <p
                                class="question"
                                style="font-size: 1.4rem"
                                v-html="question.question"
                            ></p>
                        </div>
                        <div
                            class="tab-pane active"
                            id="textarea"
                            v-if="question.type == 'essay'"
                        >
                            <div class="q-block">
                                <p style="font-size: 1.2rem; color: gray">
                                    Answer
                                </p>
                            </div>
                            <div class="question-img-block">
                                <textarea
                                    class="form-control"
                                    rows="12"
                                    v-model="result.answer_exp"
                                ></textarea>
                            </div>
                        </div>
                        <div
                            v-if="
                                !question.choices ||
                                parsedChoices(question.choices).length === 0
                            "
                            class="q-block"
                        >
                            <p style="font-size: 1.2rem; color: gray">
                                Choices
                            </p>
                        </div>
                        <div
                            class="choices-box"
                            v-if="question.type === 'multiple'"
                        >
                            <div
                                v-for="(choice, indx) in parsedChoices(
                                    question.choices
                                )"
                                :key="indx"
                            >
                                <label class="form-label">
                                    <input
                                        class="radioBtn"
                                        type="radio"
                                        :id="'radio' + indx"
                                        :value="String(choice)"
                                        v-model="result.user_answer"
                                    />
                                    <span style="font-size: 1.4rem">{{
                                        choice
                                    }}</span>
                                </label>
                            </div>
                        </div>
                        <hr />
                        <div class="row" style="padding: 10px">
                            <div class="col-md-2 col-xs-8"></div>
                            <div
                                class="col-md-8 col-xs-8"
                                style="margin-top: 10%"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-block nextbtn btn-primary"
                                    @click="status('save')"
                                    :disabled="isSelected"
                                    style="margin-top: 5px"
                                >
                                    <span v-if="!isLast">Next</span>
                                    <span v-else>Save</span>
                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-block btn-warning nextbtn"
                                    @click="status('review')"
                                    :disabled="isSelected"
                                >
                                    <span>Review</span>
                                </button>

                                <button
                                    type="submit"
                                    v-if="!isLast"
                                    class="btn btn-block nextbtn btn-danger"
                                    @click="status('skipped')"
                                    :disabled="isSkipDisabled"
                                >
                                    <span>Skip</span>
                                </button>

                                <button
                                    type="submit"
                                    v-if="
                                        isLast &&
                                        topic_id != topics[topics.length - 1]
                                    "
                                    class="btn btn-block submitBtn btn-success"
                                >
                                    <span>Proceed</span>
                                </button>

                                <button
                                    type="submit"
                                    v-if="
                                        isLast &&
                                        topic_id == topics[topics.length - 1]
                                    "
                                    class="btn btn-block submitBtn btn-success"
                                >
                                    <span>Submit</span>
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-8"></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h5 class="review-btn">
                            Question Overview
                            <span
                                class="glyphicon glyphicon-chevron-down"
                            ></span>
                        </h5>
                        <div class="sidepanel" :style="{ display: openOnNext && 'block' }">
                            <div
                                class="sidebar"
                                :style="{
                                    width: 'fit-content',
                                }"
                            >
                                <h5 style="color: gray; font-weight: 800">
                                    Question
                                </h5>
                                <div
                                    :style="{
                                        display: 'inline-block',
                                        width: 'fit-content',
                                    }"
                                    v-for="(basestats, indx) in stats"
                                    :key="indx"
                                >
                                    <button
                                        type="button"
                                        class="base prebtn"
                                        :style="{
                                            backgroundColor:
                                                baseColors[basestats.status],
                                            cursor:
                                                basestats.status === 'save' &&
                                                'not-allowed',
                                        }"
                                        @click="goToQuestion(indx)"
                                        :disabled="
                                            basestats.status === 'blank' ||
                                            basestats.status === 'save'
                                        "
                                        :value="indx + 1"
                                    >
                                        {{ indx + 1 }}
                                    </button>
                                </div>
                                <hr style="border-color: gray; width: 80%" />
                                <div
                                    style="
                                        text-align: center;
                                        display: flex;
                                        flex-direction: row;
                                        justify-items: center;
                                        align-items: start;
                                        gap: 20px;
                                    "
                                >
                                    <div>
                                        <div
                                            style="
                                                display: flex;
                                                gap: 10px;
                                                align-items: center;
                                            "
                                        >
                                            <div class="span-ans"></div>
                                            <span class="inline">Answered</span>
                                        </div>
                                        <div
                                            style="
                                                display: flex;
                                                gap: 10px;
                                                align-items: center;
                                            "
                                        >
                                            <div class="span-rev"></div>
                                            <span class="inline"
                                                >For Review</span
                                            >
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="
                                                display: flex;
                                                gap: 10px;
                                                align-items: center;
                                            "
                                        >
                                            <div class="span-unans"></div>
                                            <span class="inline">Skipped</span>
                                        </div>
                                        <div
                                            style="
                                                display: flex;
                                                gap: 10px;
                                                align-items: center;
                                            "
                                        >
                                            <div class="span-nvw"></div>
                                            <span class="inline">Not View</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="question-block-tabs"
                            v-if="
                                question.question_img != null ||
                                question.question_video_link != null ||
                                question.type == 'essay'
                            "
                        >
                            <h6 class="ques-image">
                                <span>Question Image</span>
                            </h6>
                            <hr style="margin-top: 0" />
                            <div class="tab-content">
                                <div
                                    class="tab-pane active"
                                    id="image"
                                    v-if="question.question_img != null"
                                >
                                    <div class="question-img-block">
                                        <img
                                            :src="
                                                '/storage/question_img/' +
                                                question.question_img
                                            "
                                            class="img-responsive"
                                            alt="question-image"
                                        />
                                    </div>
                                </div>
                                <!--<div class="tab-pane fade" id="video" v-if="question.question_video_link != null">
                <div class="question-video-block">
                  <h3 class="question-block-heading">Question Video</h3>
                  <iframe :id="'video'+(index+1)" width="460" height="345" :src="question.question_video_link" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { v4 as uuidv4 } from "uuid";
export default {
    props: ["topic_id"],

    data() {
        return {
            questions: [],
            answers: [],
            stats: [],
            auth: "",
            uuid: 0,
            topics: 0,
            count: 1,
            slug: "",
            // fcount: 1,
            set: 0,
            baseColors: {
                save: "#46D96C",
                review: "#F8D612",
                skipped: "#EE6266",
                blank: "#e4e8eb",
            },
            result: {
                question_id: "",
                user_answer: null,
                topic_id: "",
                user_id: "",
                answer_exp: "",
                qIndex: null,
                status: "",
            },
            openOnNext: false
        };
    },

    created() {
        this.fetchQuestions();
    },
    watch: {
        "result.qIndex"(newIndex) {
            if (
                Number.isInteger(newIndex) &&
                newIndex >= 0 &&
                newIndex < this.questions.length
            ) {
                this.result.user_answer =
                    this.questions[newIndex].user_answer ?? null;
                this.result.answer_exp =
                    this.questions[newIndex].answer_exp ?? "";
            }
        },
        count(newCount) {
            const idx = newCount - 1;
            if (idx >= 0 && idx < this.questions.length) {
                this.result.qIndex = idx;
                this.result.user_answer =
                    this.questions[idx].user_answer ?? null;
                this.result.answer_exp = this.questions[idx].answer_exp ?? "";
            }
        },
    },

    methods: {
        goToQuestion(index) {
            if (index >= 0 && index < this.questions.length) {
                this.count = index + 1;
                this.result.qIndex = index;
                this.result.user_answer =
                    this.questions[index].user_answer ?? null;
                this.result.answer_exp = this.questions[index].answer_exp ?? "";

                const currentActive =
                    document.querySelector(".myQuestion.active");
                if (currentActive) currentActive.classList.remove("active");

                const target = document.getElementById("que" + index);
                if (target) target.classList.add("active");
            }
        },
        parsedChoices(raw) {
            if (!raw) return [];
            try {
                const choices = typeof raw === "string" ? JSON.parse(raw) : raw;
                return choices.map((c) => String(c));
            } catch (e) {
                console.error("CHOICES JSON ERROR:", raw);
                return [];
            }
        },
        fetchQuestions() {
            axios
                .get(`${this.$props.topic_id}/quiz/${this.$props.topic_id}`)
                .then((response) => {
                    this.questions = response.data.questions.map((q) => {
                        q.user_answer =
                            q.user_answer != null
                                ? String(q.user_answer)
                                : null;
                        q.answer_exp = q.answer_exp ?? "";
                        try {
                            q.choices =
                                typeof q.choices === "string"
                                    ? JSON.parse(q.choices)
                                    : q.choices;
                        } catch (e) {
                            q.choices = q.choices || [];
                        }
                        q.choices = q.choices.map((c) => String(c));
                        return q;
                    });
                    this.topics = response.data.count;
                    this.auth = response.data.auth;
                    this.set = response.data.set;
                    this.slug = response.data.title;
                    this.stats = response.data.status;
                    this.uuid = uuidv4();
                    if (this.questions && this.questions.length > 0) {
                        this.result.qIndex = 0;
                        this.result.user_answer =
                            this.questions[0].user_answer ?? null;
                        this.result.answer_exp =
                            this.questions[0].answer_exp ?? "";
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        status(message) {
            this.result.status = message;
        },
        createQuestion(id, qindex) {
            this.result.qIndex = qindex;
            this.result.question_id = id;
            this.result.user_id = this.auth;
            this.result.topic_id = this.$props.topic_id;
            this.openOnNext = true;
            axios
                .post(`${this.$props.topic_id}/quiz`, this.result)
                .then((response) => {
                    let newdata = response.data.newdata;
                    if (newdata && newdata[0]) {
                        const nd = newdata[0];
                        nd.user_answer =
                            nd.user_answer != null
                                ? String(nd.user_answer)
                                : null;
                        try {
                            nd.choices =
                                typeof nd.choices === "string"
                                    ? JSON.parse(nd.choices)
                                    : nd.choices;
                        } catch (e) {
                            nd.choices = nd.choices || [];
                        }
                        nd.choices = nd.choices.map((c) => String(c));
                        this.questions.splice(nd.index, 1, nd);
                        if (this.result.qIndex === nd.index) {
                            this.result.user_answer = nd.user_answer ?? null;
                            this.result.answer_exp = nd.answer_exp ?? "";
                        }
                    }
                    this.stats = response.data.status;
                })
                .catch((e) => {
                    console.log(e);
                });
            this.result.topic_id = "";
        },
        nxtClick() {
            let index = this.result.qIndex + 1;
            if (index < this.questions.length) {
                this.count = index + 1;
                this.result.qIndex = index;
                this.result.user_answer =
                    this.questions[index].user_answer ?? null;
                this.result.answer_exp = this.questions[index].answer_exp ?? "";
            }
        },
        prvClick(i) {
            if (i >= 0 && i < this.questions.length) {
                this.count = i + 1;
                this.result.qIndex = i;
                this.result.user_answer = this.questions[i].user_answer ?? null;
                this.result.answer_exp = this.questions[i].answer_exp ?? "";
            }
        },
        check() {
            return this.topics.length;
        },
    },
    computed: {
        isLast() {
            return this.count === this.questions.length;
        },
        isDisabled() {
            if (this.isLast) {
                return true;
            }
            return !!(this.result.user_answer || this.result.answer_exp);
        },
        isSelected() {
            if (this.result.user_answer || this.result.answer_exp) {
                return false;
            }
            return true;
        },
        isSkipDisabled() {
            return this.isDisabled;
        },
    },
};
</script>
