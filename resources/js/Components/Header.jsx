import {Link} from "@inertiajs/react";

export default function Header({auth}) {
    return (
        <>
            <header>
                <div className="flex border-4 p-6 mb-5">
                    <h1 className="mr-2">Header</h1>
                    { auth.user &&
                        <>
                            <Link className="mr-2" href="/">Home</Link>
                            <Link className="mr-2" href={route('dashboard')}>Dashboard</Link>
                            {auth.user.group == 1 &&
                                <a className="mr-2" href={route('filament.admin.pages.dashboard')}>Admin</a>
                            }
                            <Link className="mr-2" href={route('logout')} method="post" as="button">Logout</Link>
                        </>
                    }

                    { !auth.user &&
                        <>
                            <Link className="mr-2" href="/">Home</Link>
                            <Link className="mr-2" href={route('login')}>Login</Link>
                            <Link className="mr-2" href={route('register')}>Register</Link>
                        </>
                    }
                </div>
            </header>
        </>
    );
}
