import { Link } from '@inertiajs/react';
import Header from "@/Components/Header.jsx";
import Footer from "@/Components/Footer.jsx";

export default function Main(props) {
    return (
        <main>
            <Header auth={props.children.props.auth}></Header>
            <article>{props.children}</article>
            <Footer auth={props.children.props.auth}></Footer>
        </main>
    );
}
